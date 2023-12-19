<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ProductService;
use App\Http\Requests\Product\ProductRequest;


class ShopController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function addShop(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $customer = Auth::guard('customer')->user();
        Shop::create([
            'name' => (string) $request->input("name"),
            'customer_id' => (string) $customer->id,
        ]);
        $customer1 = Customer::find($customer->id);
        $customer1->role = 'seller';
        $customer1->save();

        return redirect()->route('viewaccount');
    }
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }
}
