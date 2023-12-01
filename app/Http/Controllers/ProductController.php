<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        return view('product', [
            'products' => $this->productService->get(),
            'categories' => $this->productService->getMenu()
        ]);
    }
    public function show(Product $product)
    {
        return view('detailproduct', [
            'product' => $product,
            'products' => $this->productService->get(),
            'categories' => $this->productService->getMenu(),
        ]);
    }
    public function test()
    {
        return view('main');
    }
    public function showcategory(Category $category)
    {
        // Kiểm tra xem danh mục có tồn tại không
        if (!$category) {
            abort(404); // Hoặc thực hiện xử lý khác tùy vào yêu cầu của bạn
        }

        return view('product', [
            'products' => $this->productService->getProduct($category),
            'categories' => $this->productService->getMenu(),
        ]);
    }
    function searchProducts(Request $request)
    {
        $productName = $request->text;
        $categoryName = $request->text;
        $query1 = Product::query();
        $query2 = Product::query();


        if ($productName) {
            $query1->where('Name', 'like', '%' . $productName . '%');
        }

        if ($categoryName) {
            $query2->whereHas('category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            });
        }

        $result1 = $query1->get();
        $result2 = $query2->get();
        $combinedResult = $result1->merge($result2)->unique();
        return view('product', [
            'products' => $combinedResult,
            'categories' => $this->productService->getMenu()
        ]);
    }
}
