<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
            'menus'  => $this->productService->getMenu()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productService->get()
        ]);
    }

    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chỉnh sửa sản phẩm' . $product->Name,
            'product' => $product,
            'menus'  => $this->productService->getMenu(),
        ]);
    }

    public function update(Product $product, ProductRequest $request)
    {
        // $request->validate([
        //     'Name' => 'required|string|max:255',
        //     'CategoryID' => 'required|exists:categories,id',
        //     'Price' => 'required|numeric',
        //     'Description' => 'nullable|string',
        //     'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // Gọi hàm update từ service và truyền dữ liệu cần thiết
        $result = $this->productService->update($product, $request->all());

        // Kiểm tra kết quả và thực hiện chuyển hướng
        if ($result) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }

    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoa thanh cong danh muc'
            ]);
        }
        return response()->json([
            'error' => true

        ]);
    }
}
