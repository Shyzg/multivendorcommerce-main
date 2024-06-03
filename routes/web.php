<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransCallback\PaymentCallbackController;
use App\Http\Controllers\RajaOngkir\CheckOngkirController;
use App\Models\Category;

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

require __DIR__ . '/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    // Admin login
    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        // Admin logout
        Route::get('logout', 'AdminController@logout');
        // GET request to view the update password <form>, and a POST request to submit the update password <form>
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');
        // Check Admin Password
        // This route is called from the AJAX call in admin/js/custom.js page
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');
        // Update Admin Details in update_admin_details.blade.php page
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');
        // Update Vendor Details
        // In the slug we can pass: 'personal' which means update vendor personal details, or 'business' which means update vendor business details
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');
        Route::get('admins/{type?}', 'AdminController@admins');
        Route::get('view-vendor-details/{id}', 'AdminController@viewVendorDetails');
        // Menampilkan section di views admins/sections/sections.blade.php
        Route::get('sections', 'SectionController@sections');
        // Menambah dan mengubah section berdasarkan id di views admins/sections/sections.blade.php
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');
        // Menghapus section berdasarkan id
        Route::get('delete-section/{id}', 'SectionController@deleteSection');
        // Menampilkan category di views admins/categories/categories.blade.php
        Route::get('categories', 'CategoryController@categories');
        // Menambah atau mengubah category berdasarkan id di views admins/categories/categories.blade.php
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        // Menahapus category berdasarkan id
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');
        // Menampilkan product di views admins/products/products.blade.php
        Route::get('products', 'ProductsController@products');
        // Menambah atau mengubah product berdasarkan id di views admins/products/products.blade.php
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct');
        // Menghapus product berdasarkan id di views admins/products/products.blade.php
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');
        // Menghapus product image berdasarkan id
        Route::get('delete-product-image/{id}', 'ProductsController@deleteProductImage');
        // Menambah product attribute berdasarkan id di views admins/attributes/add_edit_attributes.blade.php
        Route::match(['get', 'post'], 'add-edit-attributes/{id}', 'ProductsController@addAttributes');
        // Mengubah product attribute berdasarkan id di views admins/attributes/add_edit_attributes.blade.php
        Route::match(['get', 'post'], 'edit-attributes/{id}', 'ProductsController@editAttributes');
        // Menghapus product attribute berdasarkan id
        Route::get('delete-attribute/{id}', 'ProductsController@deleteAttribute');
        // Menambah product image berdasarkan id di views admins/images/add_images.blade.php
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductsController@addImages');
        // Menghapus product image berdasarkan id
        Route::get('delete-image/{id}', 'ProductsController@deleteImage');
        // Menampilkan coupon di views admins/coupons/coupons.blade.php
        Route::get('coupons', 'CouponsController@coupons');
        // Mengubah coupon berdasarkan id di views admins/coupons/coupons.blade.php
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
        // Menghapus coupon berdasarkan id
        Route::get('delete-coupon/{id}', 'CouponsController@deleteCoupon');
        // Menampilkan user di views admins/users/users.blade.php
        Route::get('users', 'UserController@users');
        // Menghapus user berdasarkan id
        Route::get('delete-user/{id}', 'UserController@deleteUser');
        // Menampilkan order di views admin/orders/orders.blade.php
        Route::get('orders', 'OrderController@orders');
        // Menampilkan order di views admin/orders/order_details.blade.php
        Route::get('orders/{id}', 'OrderController@orderDetails');
    });
});

Route::namespace('App\Http\Controllers\Front')->group(function () {
    Route::get('/', 'IndexController@index');
    // Menampilkan halaman login register untuk customer di views front/users/login_register.blade.php
    Route::get('user/login-register', ['as' => 'login', 'uses' => 'UserController@loginRegister']);
    // User/Customer melakukan login pada form di views front/users/login_register.blade.php
    Route::post('user/login', 'UserController@userLogin');
    // User/Customer melakukan register pada form di views front/users/login_register.blade.php
    Route::post('user/register', 'UserController@userRegister');
    // User/Customer logout
    Route::get('user/logout', 'UserController@userLogout');
    // Menampilkan halaman login register untuk vendor di views front/vendors/login_register.blade.php
    Route::get('vendor/login-register', 'VendorController@loginRegister'); // render vendor login_register.blade.php page
    // Vendor melakukan register pada form di views front/vendors/login_register.blade.php
    Route::post('vendor/register', 'VendorController@vendorRegister');

    $catUrls = Category::select('url')->get()->pluck('url');
    foreach ($catUrls as $key => $url) {
        Route::match(['get', 'post'], '/' . $url, 'ProductsController@listing');
    }

    // Menampilkan halaman product detail di views front/products/detail.blade.php
    Route::get('/product/{id}', 'ProductsController@detail');
    // Menampilkan halaman semua product yang dimiliki oleh vendor berdasarkan vendor_id di views front/products/vendor_listing.blade.php
    Route::get('/products/{vendorid}', 'ProductsController@vendorListing');
    // Menampilkan halaman keranjang di views front/products/cart.blade.php
    Route::get('cart', 'ProductsController@cart')->name('cart');
    // Menambahkan produk kedalam keranjang yang ada di dalam form di front/products/cart.blade.php
    Route::post('cart/add', 'ProductsController@cartAdd');
    // Memperbarui produk kedalam keranjang yang ada di dalam form di front/products/cart_items.blade.php
    Route::post('cart/update', 'ProductsController@cartUpdate');
    // Menghapus produk kedalam keranjang yang ada di dalam form di front/products/cart_items.blade.php
    Route::post('cart/delete', 'ProductsController@cartDelete');
    Route::group(['middleware' => ['auth']], function () {
        // Menampilkan halaman detail akun user/customer di views front/users/user_account.blade.php
        Route::match(['GET', 'POST'], 'user/account', 'UserController@userAccount');
        // User/Customer melakukan perubahan kata sandi pada form di views front/users/user_account.blade.php
        Route::post('user/update-password', 'UserController@userUpdatePassword');
        // User/Customer menginput kode kupon pada form di views front/products/cart_items.blade.php
        Route::post('/apply-coupon', 'ProductsController@applyCoupon');
        // Menampilkan halaman checkout pada di views front/products/checkout.blade.php
        // Serta mengambil data dan menghapus data pada form untuk alamat pengiriman
        Route::match(['GET', 'POST'], '/checkout', 'ProductsController@checkout');
        Route::post('get-delivery-address', 'AddressController@getDeliveryAddress');
        Route::post('save-delivery-address', 'AddressController@saveDeliveryAddress');
        Route::post('remove-delivery-address', 'AddressController@removeDeliveryAddress');
        // Menampilkan halaman riwayat pemesanan di views front/orders/orders.blade.php
        Route::get('user/orders/{id?}', 'OrderController@orders');
        Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
        Route::get('payments/finish', [PaymentCallbackController::class, 'finish']);
        Route::get('payments/unfinish', [PaymentCallbackController::class, 'unfinish']);
        Route::get('payments/error', [PaymentCallbackController::class, 'error']);
        Route::get('rajaongkir/checkongkir', [CheckOngkirController::class, 'checkOngkir'])->name('check-ongkir');
    });
});
