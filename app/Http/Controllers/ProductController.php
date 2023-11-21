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
}
