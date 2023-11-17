<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategorieService
{
    public function getCategori()
    {
        return Category::all();
    }
    public function create($request)
    {
        try {
            Category::create([
                'Name' => (string) $request->input('name'),
            ]);
            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function update($menu, $request)
    {
        $menu->name = (string) $request->input('name');
        $menu->save();
        Session::flash('success', 'Cập nhật thành công danh mục');
        return true;
    }
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Category::where('id', $request->input('id'))->first();
        if ($menu) {
            return Category::where('id', $id)->delete();
        }
        return false;
    }
}
