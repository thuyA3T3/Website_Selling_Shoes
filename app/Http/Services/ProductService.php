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

    public function update($product, $request)
    {
        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công sản phẩm');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thủ lại');
            Log::info($error->getMessage());
            return false;
        }
        return true;
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
}
