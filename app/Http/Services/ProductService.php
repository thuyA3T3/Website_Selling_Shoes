<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function getMenu()
    {
        return Category::all();
    }
    public function insert($request)
    {

        try {

            Product::create([
                'Name' => (string) $request->input("Name"),
                'Description' => (string) $request->input("Description"),
                'Price' => (float) $request->input("Price"), // Sử dụng kiểu dữ liệu số thập phân thay vì chuỗi
                'CategoryID' => (int) $request->input("CategoryID"), // Sử dụng kiểu dữ liệu số nguyên thay vì chuỗi
                'thumb' => (string) $request->input("thumb"),
                'shop_id' => (int) $request->input("shop_id"),
            ]);
            Session::flash('success', 'Thêm sản phẩm thành công');
        } catch (Exception $err) {
            Session::flash('error', 'Thêm sản phẩm bị lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return Product::with('category')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($product, $data)
    {
        try {
            // Cập nhật thông tin sản phẩm
            $product->update([
                'Name' => $data['Name'],
                'CategoryID' => $data['CategoryID'],
                'Price' => $data['Price'],
                'Description' => $data['Description'],
                'thumb' => $data['thumb'],
            ]);
            return true;
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return false;
        }
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            return Product::where('id', $id)->delete();
        }
        return false;
    }
    public function getProduct($category)
    {
        $products = Product::where('CategoryID', $category->id)->get();
        return $products;
    }
}
