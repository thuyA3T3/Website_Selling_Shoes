<?php

use App\Http\Controllers\Admin\Menu\CategorieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Maincontroller as AdminMainController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController as MainProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index']);
Route::get('/product', [MainProductController::class, 'index'])->name('product');
Route::get('/detailproduct/{product}', [MainProductController::class, 'detailproduct'])->name('productdetail');



Route::get('admin/users/login', [LoginController::class, 'index'])->name('viewlogin');
Route::post('admin/users/login', [LoginController::class, 'store'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminMainController::class, 'index'])->name('admin');
        Route::prefix('categorie')->group(function () {
            Route::get('add', [CategorieController::class, 'create'])->name('viewadd');
            Route::post('add', [CategorieController::class, 'store'])->name('add');
            Route::get('list', [CategorieController::class, 'index'])->name('viewlist');
            Route::get('edit/{menu}', [CategorieController::class, 'show']);
            Route::post('edit/{menu}', [CategorieController::class, 'update'])->name('update');
            Route::DELETE('destroy', [CategorieController::class, 'destroy']);
        });
        Route::prefix('product')->group(function () {
            Route::get('add', [ProductController::class, 'create'])->name('viewaddproduct');
            Route::post('add', [ProductController::class, 'store'])->name('addproduct');
            Route::get('list', [ProductController::class, 'index'])->name('viewproduct');
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update'])->name('updateproduct');
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});
