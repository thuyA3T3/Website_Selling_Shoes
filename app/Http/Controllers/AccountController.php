<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\AccountRequest;
use App\Http\Requests\Main\RegisterRequest;
use App\Models\Oder;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Shop;

class AccountController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function show()
    {
        $customer = Auth::guard('customer')->user();
        $shops = Shop::where('customer_id', $customer->id)->get();
        $orders = Oder::where('CustomerID', $customer->id)->get();
        $orderShop = [];
        $orderdetails = [];
        foreach ($orders as $order) {
            $orderdetails = array_merge($orderdetails, $order->orderDetails->toArray());
        }
        $products = Product::all();
        $resultArray = [];
        $totalRevenueShop = [];
        foreach ($shops as $shop) {

            $shop = Shop::with('products.orders')->find($shop->id);
            $totalRevenue = 0;
            $shopID = $shop->id;

            foreach ($shop->products as $product) {

                $productName = $product->Name;
                $orderCount = $product->orders->count();
                $resultArray[] = compact('shopID', 'productName', 'orderCount');

                foreach ($product->orders as $order) {
                    $productId = $order->ProductID;

                    // Lấy giá trị sản phẩm từ bảng Product
                    $product = Product::find($productId);

                    $totalRevenue += $product->Price * $order->Quantity;

                    $foundOrder = Oder::find($order->OrderID);
                    $orderID = $order->OrderID;
                    $orderStatus = $foundOrder->status;
                    $price = $product->Price;
                    $quantity = $order->Quantity;


                    $orderShop[] = compact('productName', 'shopID', 'orderID', 'price', 'quantity', 'orderStatus');
                    // Tính tổng giá trị đơn hàng

                }
            }
            $totalRevenueShop[] = compact('shopID', 'totalRevenue');
        }
        $sortedResultArray = collect($resultArray)->sortByDesc('orderCount')->values()->all();

        return view('myaccount', [
            'customer' => $customer,
            'orderdetails' => $orderdetails,
            'products' => $products,
            'menus'  => $this->productService->getMenu(),
            'shops' => $shops,
            'orders' => $orders,
            'resultArray' => $sortedResultArray,
            'totalRevenue' => $totalRevenueShop,
            'orderShop' => $orderShop,
        ]);
    }


    public function register(Request $request)
    {
        $data['FirstName'] = $request->firstName;
        $data['LastName'] = $request->lastName;
        $data['Email'] = $request->email;
        $data['Phone'] = $request->phone;
        $data['password'] = Hash::make($request->password);

        Customer::create($data);
        Session::flash('success', 'Đăng ký thành công');

        // Tiếp tục xử lý với dữ liệu $data


        return redirect()->route('viewloginregister');
    }
    public function noregister()
    {
        Session::flash('error', 'Bạn không chấp nhân đăng kí');

        // Tiếp tục xử lý với dữ liệu $data


        return redirect()->route('viewloginregister');
    }
    public function send(RegisterRequest $request)
    {
        $customer = Customer::where('email', $request->input('email'))->first();
        if (!$customer) {
            $data = [
                'subject' => 'Shop ban giay',
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $request->input('password'),
                'confirmPassword' => $request->input('confirmPassword'),
            ];

            Mail::send('sendregister', compact('data'), function ($email) use ($data) {
                $email->subject('Check register');
                $email->to($data['email'], $data['firstName'] . $data['lastName']);
            });
            Session::flash('success', 'Hãy xác nhận đăng ký qua email của bạn');
            return redirect()->route('viewloginregister');
        }
        Session::flash('error', 'Email đã tồn tại');
        return redirect()->route('viewloginregister');
    }
    public function showNewPass()
    {
        return view('forgot_password');
    }
    public function sendNewPass(AccountRequest $request)
    {

        $pass = $request->password;
        $mail = $request->email;
        $customer = Customer::where('email', $mail)->first();
        if ($customer) {
            Mail::send('send_forgot', compact('pass', 'mail'), function ($email) use ($mail) {
                $email->subject('Check forgot password');
                $email->to($mail);
            });
            Session::flash('success', 'Hãy xác nhận qua email của bạn');
            return redirect()->route('viewloginregister');
        }
        Session::flash('error', 'Email không tồn tại');
        return redirect()->route('showNewPass');
    }
    public function accept(Request $request)
    {
        $customer = Customer::where('email', $request->mail)->first();
        $customer->password = Hash::make($request->pass);
        $customer->save();

        // Gửi email thông báo hoặc thực hiện các hành động khác

        Session::flash('success', 'Mật khẩu đã được thay đổi');
        return redirect()->route('viewloginregister');
    }
    public function refuse(Request $request)
    {
        Session::flash('error', 'Ai đó đang cố truy cập tài khoản của bạn');
        return redirect()->route('viewloginregister');
    }
    public function updateUser(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $user = Customer::find($userId);

        if ($user) {
            $user->FirstName = $request->input('firstName');
            $user->LastName = $request->input('lastName');
            $user->address = $request->input('address');
            $user->Phone = $request->input('phone');
            $user->save();

            return redirect()->back();
        } else {
            // Xử lý trường hợp không tìm thấy người dùng
            return redirect()->back()->with('error', 'Người dùng không tồn tại');
        }
    }
    public function updatePassword(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $user = Customer::find($userId);
        $this->validate($request, [
            'oldPassword' => 'required|password',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ], [
            'oldPassword.password' => 'The current password is incorrect.',
            'confirmPassword.same' => 'The new password and confirm password must match.',
        ]);
        $user->update(['password' => Hash::make($request->input('newPassword'))]);
        return redirect()->route('viewloginregister')->with('error', 'Bạn cần đăng nhập lại sau khi đổi mật khẩu');
    }
}
