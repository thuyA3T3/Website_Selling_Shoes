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
        $product = Product::find($request->input('id'));
        $quantity = $request->input('quantity') ?? 1;
        $cart->add($product, $quantity);
        return response()->json(['message' => 'Success']);
    }
    public function add1(Request $request, Cart $cart)
    {
        $product = Product::find($request->input('id'));
        $quantity = $request->input('quantity') ?? 1;
        $cart->add($product, $quantity);
        return redirect()->route('viewcart');
    }
    public function update(Request $request)
    {
        dd($request);
        $id = $request->input('id');
        $quantity = $request->input('quantityProduct');
        $cart = new Cart();
        $cart->updateQuantity($id, $quantity);
        return redirect()->route('viewcart');
    }
    public function index(Cart $cart)
    {
        $cartItems = $cart;
        return view('cart', compact('cartItems'));
    }

    public function destroy(Request $request)
    {
        $productId = $request->input('id');
        $cart = new Cart();
        $cart->remove($productId);
        return redirect()->route('viewcart');
    }
}
