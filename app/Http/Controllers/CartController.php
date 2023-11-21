<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function add(Request $request, Cart $cart)
    {
        $product = Product::find($request->id);
        $quantity = $request->quantity;
        $cart->add($product, $quantity);
        return redirect()->route('viewcart');
    }
    public function index(Cart $cart)
    {
        $cartItems = $cart;
        return view('cart', compact('cartItems'));
    }
}
