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


class AccountController extends Controller
{
    //
    public function show()
    {
        $orderdetals = OrderDetail::all();
        $products = Product::all();

        return view('myaccount', [

            'orderdetails' => $orderdetals,
            'products' => $products,
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
}
