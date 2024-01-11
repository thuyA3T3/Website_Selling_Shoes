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
            'thumb' => (string) $request->input("thumb"),
        ]);
        $customer1 = Customer::find($customer->id);
        if ($customer1->role == 'customer') {
            $customer1->role = 'wait';
        }

        $customer1->save();

        return redirect()->route('viewaccount');
    }
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $result = $this->productService->destroy1($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoa thanh cong shop'
            ]);
        }
        return response()->json([
            'error' => true

        ]);
    }
    public function edit(Request $request)
    {

        $shopId = $request->input('id');
        $shop = Shop::find($shopId);
        $shop->update([
            'name' => $request->input('name'),
            'thumb' => $request->input('thumb'),

        ]);
        return redirect()->back();
    }
}
