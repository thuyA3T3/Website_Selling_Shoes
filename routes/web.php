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
use App\Http\Controllers\LoginController;

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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/category/{category}', [ProductController::class, 'showcategory']);

Route::get('/product/{product}', [ProductController::class, 'show']);
Route::get('/cart', [CartController::class, 'index'])->name('viewcart');
Route::post('/add-cart1', [CartController::class, 'add1'])->name('addcart1');
Route::post('/add-cart', [CartController::class, 'add'])->name('addcart');
Route::post('/updateCart', [CartController::class, 'update'])->name('updateCart');


Route::DELETE('/destroy/{productid}', [CartController::class, 'destroy']);
Route::get('/login_register', [LoginController::class, 'show'])->name('viewloginregister');
Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::get('/noregister', [AccountController::class, 'noregister'])->name('noregister');
Route::post('/login', [LoginController::class, 'login'])->name('mainlogin');
Route::post('/send', [AccountController::class, 'send']);
Route::get('forgot-password', [AccountController::class, 'showNewPass'])->name('showNewPass');
Route::get('send-forgot-password', [AccountController::class, 'sendNewPass'])->name('sendNewPass');
Route::get('accept-password', [AccountController::class, 'accept'])->name('acceptPass');
Route::get('refuse-password', [AccountController::class, 'refuse'])->name('refusePass');




Route::middleware(['customer'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('viewcheckout');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/account', [AccountController::class, 'show'])->name('viewaccount');
    Route::get('/signOut', [LoginController::class, 'signOut'])->name('logout');
    Route::get('/viewOder', [AccountController::class, 'order'])->name('order');
    Route::get('/accept-order/{oder}/{token}', [CheckoutController::class, 'accept'])->name('accept');
    Route::get('/refuse-order/{oder}/{token}', [CheckoutController::class, 'refuse'])->name('refuse');
});



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
