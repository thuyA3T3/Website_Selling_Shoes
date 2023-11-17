<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\CategorieService;
use App\Models\Category;

class CategorieController extends Controller
{
    protected $categoriService;

    public function __construct(CategorieService $categoriService)
    {
        $this->categoriService = $categoriService;
    }
    //
    public function create()
    {
        return view('admin.menu.add', [
            'title' => 'Thêm danh mục mới',
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $this->categoriService->create($request);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => "Danh sách danh mục",
            'menus' => $this->categoriService->getCategori()
        ]);
    }
    public function show(Category $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Chỉnh sửa danh mục' . $menu->name,
            'menu'  => $menu,
        ]);
    }
    public function update(Category $menu, CreateFormRequest $request)
    {
        $this->categoriService->update($menu, $request);
        return redirect('/admin/categorie/list');
    }
    public function destroy(Request $request)
    {
        $result = $this->categoriService->destroy($request);
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
