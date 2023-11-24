<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Services\CheckoutService;
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
    public function checkout(Request $request, Cart $carts)
    {
        $customer = Auth::guard('customer')->user();
        $address = $request->address1 . ', ' . $request->address2 . ', ' . $request->address3;
        $result = $this->checkoutService->oder($customer, $carts, $address);
    }
}
