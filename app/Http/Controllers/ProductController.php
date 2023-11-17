<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;
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
    public function detailproduct(Product $product)
    {
        return view('detailproduct', [
            'products' => $product,
        ]);
    }
}
