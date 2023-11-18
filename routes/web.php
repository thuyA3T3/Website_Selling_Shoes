<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\Menu\CategorieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\LoginController as AdminLogincontroller;
use App\Http\Controllers\Admin\Product\ProductController as AdminProdcuctController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Maincontroller as AdminMainController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginControlller;

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
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/category/{category}', [ProductController::class, 'showcategory']);

Route::get('/product/{product}', [ProductController::class, 'show']);
Route::get('/cart', [CartController::class, 'show'])->name('viewcart');
Route::get('/login_register', [LoginControlller::class, 'show'])->name('viewloginregister');


Route::get('/checkout', [CheckoutController::class, 'show'])->name('viewcheckout');
Route::get('/account', [AccountController::class, 'show'])->name('viewaccount');
Route::get('/product1', [ProductController::class, 'test']);




Route::get('admin/users/login', [AdminLogincontroller::class, 'index'])->name('viewlogin');
Route::post('admin/users/login', [AdminLogincontroller::class, 'store'])->name('login');

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
            Route::get('add', [AdminProdcuctController::class, 'create'])->name('viewaddproduct');
            Route::post('add', [AdminProdcuctController::class, 'store'])->name('addproduct');
            Route::get('list', [AdminProdcuctController::class, 'index'])->name('viewproduct');
            Route::get('edit/{product}', [AdminProdcuctController::class, 'show']);
            Route::post('edit/{product}', [AdminProdcuctController::class, 'update'])->name('updateproduct');
            Route::DELETE('destroy', [AdminProdcuctController::class, 'destroy']);
        });
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});
