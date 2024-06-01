<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransCallback\PaymentCallbackController;
use App\Http\Controllers\RajaOngkir\CheckOngkirController;

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
    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        // Admin login
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

        // Menampilkan shipping di views admin/shipping/shipping_charges.blade.php
        Route::get('shipping-charges', 'ShippingController@shippingCharges');
        // Mengubah shipping berdasarkan id di views admins/shipping/edit_shipping_charges.blade.php
        Route::match(['get', 'post'], 'edit-shipping-charges/{id}', 'ShippingController@editShippingCharges');
    });
});

// handling after payment midtrans
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
// handling finish payment url
Route::get('payments/finish', [PaymentCallbackController::class, 'finish']);
// handling unfinish payment url
Route::get('payments/unfinish', [PaymentCallbackController::class, 'unfinish']);
// handling error payment url
Route::get('payments/error', [PaymentCallbackController::class, 'error']);

Route::namespace('App\Http\Controllers\Front')->group(function () {
    Route::get('/', 'IndexController@index');

    $catUrls = \App\Models\Category::select('url')->get()->pluck('url');
    foreach ($catUrls as $key => $url) {
        Route::match(['get', 'post'], '/' . $url, 'ProductsController@listing');
    }

    // Menampilkan halaman login register di views front/vendors/login_register.blade.php
    Route::get('vendor/login-register', 'VendorController@loginRegister'); // render vendor login_register.blade.php page
    // Vendor register pada form
    Route::post('vendor/register', 'VendorController@vendorRegister'); // the register HTML form submission in vendor login_register.blade.php page

    // Menampilkan halaman product detail di views front/products/detail.blade.php
    Route::get('/product/{id}', 'ProductsController@detail');
    // Menampilkan halaman semua product yang dimiliki oleh vendor berdasarkan vendor_id di views front/products/vendor_listing.blade.php
    Route::get('/products/{vendorid}', 'ProductsController@vendorListing');

    // Add to Cart <form> submission in front/products/detail.blade.php
    Route::post('cart/add', 'ProductsController@cartAdd');

    // Render Cart page (front/products/cart.blade.php)    // this route is accessed from the <a> HTML tag inside the flash message inside cartAdd() method in Front/ProductsController.php (inside front/products/detail.blade.php)
    Route::get('cart', 'ProductsController@cart')->name('cart');

    // Update Cart Item Quantity AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js
    Route::post('cart/update', 'ProductsController@cartUpdate');

    // Delete a Cart Item AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js
    Route::post('cart/delete', 'ProductsController@cartDelete');

    // Render User Login/Register page (front/users/login_register.blade.php)
    Route::get('user/login-register', ['as' => 'login', 'uses' => 'UserController@loginRegister']); // 'as' => 'login'    is Giving this route a name 'login' route in order for the 'auth' middleware ('auth' middleware is the Authenticate.php) to redirect to the right page

    // User Registration (in front/users/login_register.blade.php) <form> submission using an AJAX request. Check front/js/custom.js
    Route::post('user/register', 'UserController@userRegister');
    // User Login (in front/users/login_register.blade.php) <form> submission using an AJAX request. Check front/js/custom.js
    Route::post('user/login', 'UserController@userLogin');
    // User logout (This route is accessed from Logout tab in the drop-down menu in the header (in front/layout/header.blade.php))
    Route::get('user/logout', 'UserController@userLogout');

    Route::group(['middleware' => ['auth']], function () {
        // Render User Account page with 'GET' request (front/users/user_account.blade.php), or the HTML Form submission in the same page with 'POST' request using AJAX (to update user details). Check front/js/custom.js
        Route::match(['GET', 'POST'], 'user/account', 'UserController@userAccount');

        // User Account Update Password HTML Form submission via AJAX. Check front/js/custom.js
        Route::post('user/update-password', 'UserController@userUpdatePassword');

        // Coupon Code redemption (Apply coupon) / Coupon Code HTML Form submission via AJAX in front/products/cart_items.blade.php, check front/js/custom.js
        Route::post('/apply-coupon', 'ProductsController@applyCoupon'); // Important Note: We added this route here as a protected route inside the 'auth' middleware group because ONLY logged in/authenticated users are allowed to redeem Coupons!

        // Checkout page (using match() method for the 'GET' request for rendering the front/products/checkout.blade.php page or the 'POST' request for the HTML Form submission in the same page (for submitting the user's Delivery Address and Payment Method))
        Route::match(['GET', 'POST'], '/checkout', 'ProductsController@checkout');

        // Edit Delivery Addresses (Page refresh and fill in the <input> fields with the authenticated/logged in user Delivery Addresses from the `delivery_addresses` database table when clicking on the Edit button) in front/products/delivery_addresses.blade.php (which is 'include'-ed in front/products/checkout.blade.php) via AJAX, check front/js/custom.js
        Route::post('get-delivery-address', 'AddressController@getDeliveryAddress');

        // Save Delivery Addresses via AJAX (save the delivery addresses of the authenticated/logged-in user in `delivery_addresses` database table when submitting the HTML Form) in front/products/delivery_addresses.blade.php (which is 'include'-ed in front/products/checkout.blade.php) via AJAX, check front/js/custom.js
        Route::post('save-delivery-address', 'AddressController@saveDeliveryAddress');

        // Remove Delivery Addresse via AJAX (Page refresh and fill in the <input> fields with the authenticated/logged-in user Delivery Addresses details from the `delivery_addresses` database table when clicking on the Remove button) in front/products/delivery_addresses.blade.php (which is 'include'-ed in front/products/checkout.blade.php) via AJAX, check front/js/custom.js
        Route::post('remove-delivery-address', 'AddressController@removeDeliveryAddress');
        // Rendering Thanks page (after placing an order)
        Route::get('thanks', 'ProductsController@thanks');
        // Render User 'My Orders' page
        Route::get('user/orders/{id?}', 'OrderController@orders');

        Route::get('rajaongkir/checkongkir', [CheckOngkirController::class, 'checkOngkir'])->name('check-ongkir');
    });
});
