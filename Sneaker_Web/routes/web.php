<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OderListController;
use App\Http\Controllers\Admin\OrderListController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\WareHouseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\Forgotcontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\paymentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserMainController;
use App\Http\Controllers\UserMenuController;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/forgot', [Forgotcontroller::class, 'index']);
Route::get('/resetPassword', [Forgotcontroller::class, 'resetPassword']);
Route::post('/resetPassword', [Forgotcontroller::class, 'update']);

Route::get('/changePassword', [Forgotcontroller::class, 'changePassword']);
Route::post('/changePassword', [Forgotcontroller::class, 'updateChangePassword']);

Route::post('login', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {

        Route::prefix('admin')->group(function () {
            Route::get('/', [MainController::class, 'index'])->name('admin');
            Route::get('/main', [MainController::class, 'index']);
            Route::get('/customer', [OrderListController::class, 'index']);
            Route::post('/customer', [OrderListController::class, 'search'])->name('searchOrder');
            Route::get('/customer/view/{customer}', [OrderListController::class, 'show']);
            Route::post('/update-status/{customer_id}', [OrderListController::class, 'updateStatus'])->name('update.status');
            Route::delete('order_product/destroy', [OrderListController::class, 'destroy']);
            Route::delete('customer/destroy', [OrderListController::class, 'destroyCustomer']);
            Route::post('/filterByDate', [MainController::class, 'filterByDate'])->name('filterByDate');


            Route::prefix('menus')->group(function () {
                Route::get('add', [MenuController::class, 'create']);
                Route::post('add', [MenuController::class, 'store']);
                Route::get('list', [MenuController::class, 'index']);
                Route::post('list', [MenuController::class, 'search'])->name('searchMenu');;
                Route::get('edit/{menu}', [MenuController::class, 'show']);
                Route::post('edit/{menu}', [MenuController::class, 'update']);
                Route::delete('destroy', [MenuController::class, 'destroy']);
            });

            Route::prefix('product')->group(function () {
                Route::get('add', [ProductController::class, 'create']);
                Route::post('add', [ProductController::class, 'store']);
                Route::get('list', [ProductController::class, 'index']);
                Route::post('list', [ProductController::class, 'search'])->name('searchProduct');;
                Route::get('edit/{product}', [ProductController::class, 'show']);
                Route::post('edit/{product}', [ProductController::class, 'update']);
                Route::delete('destroy', [ProductController::class, 'destroy']);
            });

            Route::prefix('productImage')->group(function () {
                Route::get('list', [ProductImageController::class, 'index']);
                Route::post('list', [ProductImageController::class, 'search'])->name('searchProductImage');
                Route::get('add', [ProductImageController::class, 'create']);
                Route::post('add', [ProductImageController::class, 'store']);
                Route::get('edit/{productImage}', [ProductImageController::class, 'show']);
                Route::post('edit/{productImage}', [ProductImageController::class, 'update']);
                Route::delete('destroy', [ProductImageController::class, 'destroy']);
            });

            Route::prefix('warehouse')->group(function () {
                Route::get('list', [WareHouseController::class, 'index']);
                Route::post('list', [WareHouseController::class, 'search'])->name('searchWarehouse');
                Route::get('detail/{product_id}', [WareHouseController::class, 'datail']);
                Route::get('add', [WareHouseController::class, 'create']);
                Route::post('add', [WareHouseController::class, 'store']);
                Route::get('edit/{warehouse}', [WareHouseController::class, 'show']);
                Route::post('edit/{warehouse}', [WareHouseController::class, 'update']);
                Route::delete('destroyDetail', [WareHouseController::class, 'destroyDetail']);
                Route::delete('destroy', [WareHouseController::class, 'destroy']);
            });

            Route::prefix('supplier')->group(function () {
                Route::get('list', [SupplierController::class, 'index']);
                Route::post('list', [SupplierController::class, 'search'])->name('searchSupplier');
                Route::get('add', [SupplierController::class, 'create']);
                Route::post('add', [SupplierController::class, 'store']);
                Route::get('edit/{supplier}', [SupplierController::class, 'show']);
                Route::post('edit/{supplier}', [SupplierController::class, 'update']);
                Route::delete('destroy', [SupplierController::class, 'destroy']);
            });

            Route::post('detail', []);

            #upload
            Route::post('upload/services', [UploadController::class, 'store']);

            Route::get('account/list', [AccountController::class, 'index'])->name('admin.account.list');
            Route::post('account/list', [AccountController::class, 'search'])->name('searchAccount');
            Route::get('account/edit/{account}', [AccountController::class, 'show']);
            Route::post('account/edit/{account}', [AccountController::class, 'updateAccount']);
            Route::delete('account/destroy', [AccountController::class, 'destroy']);
        });
    });

    Route::post('review/{id}', [ReviewProductController::class, 'store'])->name('reviewProduct');
});

Route::get('index', [UserMainController::class, 'index'])->name('home');
Route::post('index', [UserMainController::class, 'search'])->name('searchHome');
Route::post('services/load-product', [UserMainController::class, 'loadProduct']);

Route::get('danh-muc/{id}-{slug}', [UserMenuController::class, 'index']);
Route::post('danh-muc/{id}-{slug}', [UserMenuController::class, 'search'])->name('UserSearchProduct');
Route::get('san-pham/{id}-{slug}', [DetailProductController::class, 'index']);

Route::post('add', [CartController::class, 'index'])->name('addcart');
Route::get('carts', [CartController::class, 'show']);
// Route::get('/cart',[CartController::class,'showCart']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'destroy']);
Route::get('pay', [paymentsController::class, 'pay']);
Route::post('pay', [paymentsController::class, 'order']);
Route::post('vnpay_payment', [paymentsController::class, 'order']);
Route::get ('/vnpay-return', [paymentsController::class, 'VNPayReturn']);
//Route::post('momo_payment', [paymentsController::class, 'Momo']);
// Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/profileUser/profile', [ProfileController::class, 'showProfile']);
Route::post('/profileUser/profile', [ProfileController::class, 'store']);
Route::get('/profileUser/order', [ProfileController::class, 'order']);
Route::post('/upload/services', [UploadController::class, 'store']);