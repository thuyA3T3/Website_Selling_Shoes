<?php

namespace App\Http\Services;

use App\Helpers\Cart;
use App\Models\Oder;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Can;

class CheckoutService
{
    public function oder($customer, $carts, $address)
    {
        foreach ($carts->list() as $cart) {
            $data['CustomerID'] = $customer->id;
            $data['OrderDate'] = now();
            $data['TotalAmount'] = $cart['price'] * $cart['quantity'] + 1;
            $oder = Oder::create($data);
            $datadetail['OrderID'] = $oder->id;
            $datadetail['ProductID'] = $cart['productid'];
            $datadetail['Quantity'] = $cart['quantity'];
            $datadetail['Address'] = $address;
            $oderdetail = OrderDetail::create($datadetail);
        }
        Mail::send('send', compact('oder', 'oderdetail', 'customer'), function ($email) use ($customer) {
            $email->subject('Check order');
            $email->to($customer->Email, $customer->FirstName . $customer->LastName);
        });
        $removeCart = new Cart();
        $removeCart->clearCart();
    }
}
