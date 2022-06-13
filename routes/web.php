<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryController;
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
/* frontend */
Route::get('/',[HomeController::class, 'index']);
Route::get('/trang-chu',[HomeController::class, 'index']);
Route::post('/tim-kiem',[HomeController::class, 'search']);

/* danh muc san pham trang chu */
Route::get('/danh-muc-san-pham/{category_id}',[CategoryProduct::class, 'show_category_home']);

/* thuong hieu san pham trang chu */
Route::get('/thuong-hieu-san-pham/{brand_id}',[BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}',[Product::class, 'details_product']);


/* backend */
Route::get('/admin',[AdminController::class, 'index']);

Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);

Route::get('/logout',[AdminController::class, 'logout']);
Route::post('/logout',[AdminController::class, 'logout']);

/*Catagory product */
Route::get('/add-category-product',[CategoryProduct::class, 'add_category_products']);
Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class, 'delete_category_product']);

Route::get('/all-category-product',[CategoryProduct::class, 'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class, 'active_category_product']);

Route::post('/save-category-product',[CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class, 'update_category_product']);

/*Brand product */
Route::get('/add-brand-product',[BrandProduct::class, 'add_brand_products']);
Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class, 'delete_brand_product']);

Route::get('/all-brand-product',[BrandProduct::class, 'all_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}',[BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProduct::class, 'active_brand_product']);

Route::post('/save-brand-product',[BrandProduct::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProduct::class, 'update_brand_product']);

/* product */
Route::get('/add-product',[Product::class, 'add_products']);
Route::get('/edit-product/{product_id}',[Product::class, 'edit_product']);
Route::get('/delete-product/{product_id}',[Product::class, 'delete_product']);

Route::get('/all-product',[Product::class, 'all_product']);

Route::get('/unactive-product/{product_id}',[Product::class, 'unactive_product']);
Route::get('/active-product/{product_id}',[Product::class, 'active_product']);

Route::post('/save-product',[Product::class, 'save_product']);
Route::post('/update-product/{product_id}',[Product::class, 'update_product']);

// Add to cart
Route::post('/save-cart',[CartController::class, 'save_cart']);
Route::get('/show-cart',[CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class, 'delete_to_cart']);
Route::post('/update-cart-quantity',[CartController::class, 'update_cart_quantity']);

Route::post('/add-cart-ajax',[CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang',[CartController::class, 'gio_hang']);

// Check out
Route::get('/login-checkout',[CheckoutController::class, 'login_checkout']);
Route::post('/add-customer',[CheckoutController::class, 'add_customer']);
Route::get('/checkout',[CheckoutController::class, 'checkout']);
Route::post('/save-checkout-customer',[CheckoutController::class, 'save_checkout_customer']);
Route::get('/logout-checkout',[CheckoutController::class, 'logout_checkout']);
Route::post('/login-customer',[CheckoutController::class, 'login_customer']);
Route::get('/payment',[CheckoutController::class, 'payment']);
Route::post('/order-place',[CheckoutController::class, 'order_place']);

// Order
Route::get('/manage-order',[CheckoutController::class, 'manage_order']);
Route::get('/view-order/{orderId}',[CheckoutController::class, 'view_order']);

//Send mail
Route::get('/send-mail',[HomeController::class, 'send_mail']);

//delivery- van chuyen
Route::get('/delivery',[DeliveryController::class, 'delivery']);
Route::post('/select-delivery',[DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery',[DeliveryController::class, 'insert_delivery']);