<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Services\CheckoutService;
use App\Models\Customer;
use App\Models\Oder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    protected $checkoutService;
    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function show(Cart $cart)
    {
        $cartItems = $cart;
        $customer = Auth::guard('customer')->user();
        return view('checkout', [
            'customer' => $customer,
            'cartItems' => $cartItems,
        ]);
    }
    public function bynow(Product $id)
    {
        $product = $id;
        $customer = Auth::guard('customer')->user();
        return view('checkout', [
            'customer' => $customer,
            'product' => $product
        ]);
    }
    public function checkout(Request $request, Cart $carts)
    {
        $customer = Auth::guard('customer')->user();
        $address = $request->address1 . ', ' . $request->address2 . ', ' . $request->address3;
        $id = $request->input('productID');
        $product = Product::find($id);
        if ($product) {
            $result = $this->checkoutService->oder1($customer, $product, $address);
            return redirect()->route('viewaccount');
        }
        $result = $this->checkoutService->oder($customer, $carts, $address);
        return redirect()->route('viewaccount');
    }
    public function accept(Oder $oder, $token)
    {
        return redirect()->route('viewaccount');
    }
    public function refuse(Oder $oder, $token)
    {
        $oder->delete();
        return redirect()->route('viewaccount');
    }
    public function pending(Request $request)
    {
        $id = $request->input('id');
        $select = $request->input('select');
        $order = Oder::find($id);
        $order->status = $select;
        $order->save();
    }
}
