<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

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
//frontend
Route::get('/',[HomeController::class, 'index']);
Route::get('/trang-chu',[HomeController::class, 'index']);
Route::post('/tim-kiem',[HomeController::class, 'search']);
//Danh mục sản phẩm của trang chủ
Route::get('/danh-muc-san-pham/{category_id}',[CategoryProduct::class, 'show_category_home']);
//Thuong hieu san pham trang chu
Route::get('/thuong-hieu-san-pham/{brand_id}',[BrandProduct::class, 'show_brand_home']);
//Chi tiet san pham
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class, 'details_product']);

//backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::get('/logout',[AdminController::class, 'logout']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);

//CategoryProduct
Route::get('/add-category-product',[CategoryProduct::class, 'add_category_product']);
Route::get('/update-category-product/{category_product_id}',[CategoryProduct::class, 'update_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class, 'delete_category_product']);
Route::get('/all-category-product',[CategoryProduct::class, 'all_category_product']);

//hiển thị, trạng thái
Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class, 'active_category_product']);

//Thêm category product
Route::post('/save-category-product',[CategoryProduct::class, 'save_category_product']);
Route::post('/updates-category-product/{category_product_id}',[CategoryProduct::class, 'updates_category_product']);


//BrandProduct
Route::get('/add-brand-product',[BrandProduct::class, 'add_brand_product']);
Route::get('/update-brand-product/{brand_product_id}',[BrandProduct::class, 'update_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class, 'delete_brand_product']);
Route::get('/all-brand-product',[BrandProduct::class, 'all_brand_product']);

//hiển thị, trạng thái
Route::get('/unactive-brand-product/{brand_product_id}',[BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProduct::class, 'active_brand_product']);

//Thêm brand product
Route::post('/save-brand-product',[BrandProduct::class, 'save_brand_product']);
//Cập nhật brand product
Route::post('/updates-brand-product/{brand_product_id}',[BrandProduct::class, 'updates_brand_product']);

//Size
Route::get('/add-size',[SizeController::class, 'add_size']);
Route::get('/update-size/{size_id}',[SizeController::class, 'update_size']);
Route::get('/delete-size/{size_id}',[SizeController::class, 'delete_size']);
Route::get('/all-size',[SizeController::class, 'all_size']);

//hiển thị, trạng thái
Route::get('/unactive-size/{size_id}',[SizeController::class, 'unactive_size']);
Route::get('/active-size/{size_id}',[SizeController::class, 'active_size']);

//Thêm size
Route::post('/save-size',[SizeController::class, 'save_size']);
//Cập nhật size
Route::post('/updates-size/{size_id}',[SizeController::class, 'updates_size']);

//Color
Route::get('/add-color',[ColorController::class, 'add_color']);
Route::get('/update-color/{color_id}',[ColorController::class, 'update_color']);
Route::get('/delete-color/{color_id}',[ColorController::class, 'delete_color']);
Route::get('/all-color',[ColorController::class, 'all_color']);

//hiển thị, trạng thái
Route::get('/unactive-color/{color_id}',[ColorController::class, 'unactive_color']);
Route::get('/active-color/{color_id}',[ColorController::class, 'active_color']);

//Thêm Color
Route::post('/save-color',[ColorController::class, 'save_color']);
//Cập nhật color
Route::post('/updates-color/{color_id}',[ColorController::class, 'updates_color']);

//Product
Route::get('/add-product',[ProductController::class, 'add_product']);
Route::get('/update-product/{product_id}',[ProductController::class, 'update_product']);
Route::get('/delete-product/{product_id}',[ProductController::class, 'delete_product']);
Route::get('/all-product',[ProductController::class, 'all_product']);

//hiển thị, trạng thái
Route::get('/unactive-product/{product_id}',[ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class, 'active_product']);

//Thêm product
Route::post('/save-product',[ProductController::class, 'save_product']);
//Cập nhật product
Route::post('/updates-product/{product_id}',[ProductController::class, 'updates_product']);

//Cart ajax
Route::post('/add-cart-ajax',[CartController::class, 'add_cart_ajax']);
//update cart ajax
Route::post('/update-cart',[CartController::class, 'update_cart']);
Route::get('/gio-hang',[CartController::class, 'gio_hang']);
//delete cart ajax
Route::get('/delete-cart/{session_id}',[CartController::class, 'delete_cart']);
Route::get('/delete-all-cart',[CartController::class, 'delete_all_cart']);

//cart darryldecode
Route::post('/save-cart',[CartController::class, 'save_cart']);
Route::post('/update-cart-quantity',[CartController::class, 'update_cart_quantity']);
Route::get('/show-cart',[CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{id}',[CartController::class, 'delete_to_cart']);

//Chechkout
Route::get('/login-checkout',[CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout',[CheckoutController::class, 'logout_checkout']);
Route::post('/login-customer',[CheckoutController::class, 'login_customer']);
Route::post('/add-customer',[CheckoutController::class, 'add_customer']);
Route::get('/checkout',[CheckoutController::class, 'checkout']);
Route::post('/save-checkout',[CheckoutController::class, 'save_checkout']);
Route::get('/payment',[CheckoutController::class, 'payment']);

