<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shop;

class ProductController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index(Category $category = null, $sortBy = 'Name', $sortOrder = 'asc')
    {
        // Kiểm tra xem danh mục có tồn tại không
        $products = $category ? $this->productService->getProduct1($category, $sortBy, $sortOrder) : $this->productService->get1($sortBy, $sortOrder);


        return view('product', [
            'products' => $products,
            'categories' => $this->productService->getMenu(),
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'category' => $category,
        ]);
    }
    public function show(Product $product)
    {
        $reviews = $product->reviews;
        $averageRating = number_format($reviews->avg('rating'), 1);
        $shop = $product->shop;
        return view('detailproduct', [
            'product' => $product,
            'products' => $this->productService->get(),
            'categories' => $this->productService->getMenu(),
            'shop' => $shop,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
        ]);
    }
    public function test()
    {
        return view('main');
    }
    public function showcategory(Category $category = null, Request $request)
    {
        $sortBy = $request->input('sort_by', 'Name');
        $sortOrder = $request->input('sort_order', 'asc');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        // Kiểm tra xem danh mục có tồn tại không
        if (!$category || !$category->exists) {
            $products = $this->productService->getProductsWithPriceFilter(null, $sortBy, $sortOrder, $minPrice, $maxPrice);
        } else {
            $products = $this->productService->getProductsWithPriceFilter($category, $sortBy, $sortOrder, $minPrice, $maxPrice);
        }

        return view('product', [
            'products' => $products,
            'categories' => $this->productService->getMenu(),
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'category' => $category,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
    function searchProducts(Category $category = null, Request $request)
    {
        $sortBy = $request->input('sort_by', 'Name');
        $sortOrder = $request->input('sort_order', 'asc');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        if (!$category || !$category->exists) {
            $products = $this->productService->getProductsWithPriceFilter(null, $sortBy, $sortOrder, $minPrice, $maxPrice);
        } else {
            $products = $this->productService->getProductsWithPriceFilter($category, $sortBy, $sortOrder, $minPrice, $maxPrice);
        }
        $productName = $request->text;
        $categoryName = $request->text;
        $query1 = Product::query();
        $query2 = Product::query();


        if ($productName) {
            $query1->where('Name', 'like', '%' . $productName . '%');
        }

        if ($categoryName) {
            $query2->whereHas('category', function ($query) use ($categoryName) {
                $query->where('name', 'like', '%' .  $categoryName . '%');
            });
        }

        $result1 = $query1->get();
        $result2 = $query2->get();
        $combinedResult = $result1->merge($result2)->unique();
        return view('product', [
            'products' => $combinedResult,
            'categories' => $this->productService->getMenu(),
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'category' => $category,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,

        ]);
    }
    public function review(Request $request)
    {
        $customer_id = $request->input('customerReview');
        $product_id = $request->input('productReview');
        $rating = $request->input('starReview');
        $comment = $request->input('comment');
        $review = new Review([
            'customer_id' => $customer_id,
            'product_id' => $product_id,
            'rating' => $rating,
            'comment' => $comment,
        ]);

        // Lưu đối tượng Review vào cơ sở dữ liệu hoặc thực hiện các thao tác khác tùy thuộc vào logic ứng dụng
        $review->save();
        return redirect('/product/' . $product_id . '/#reviews');
    }
}
