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

        // Sections (Sections, Categories, Subcategories, Products, Attributes)
        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus'); // Update Sections Status using AJAX in sections.blade.php
        Route::get('delete-section/{id}', 'SectionController@deleteSection'); // Delete a section in sections.blade.php
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection'); // the slug {id?} is an Optional Parameter, so if it's passed, this means Edit/Update the section, and if not passed, this means Add a Section

        // Categories
        Route::get('categories', 'CategoryController@categories'); // Categories in Catalogue Management in Admin Panel
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory'); // the slug {id?} is an Optional Parameter, so if it's passed, this means Edit/Update the Category, and if not passed, this means Add a Category
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory'); // Delete a category in categories.blade.php
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage'); // Delete a category image in add_edit_category.blade.php from BOTH SERVER (FILESYSTEM) & DATABASE

        // Products
        Route::get('products', 'ProductsController@products'); // render products.blade.php in the Admin Panel
        Route::post('update-product-status', 'ProductsController@updateProductStatus'); // Update Products Status using AJAX in products.blade.php
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct'); // Delete a product in products.blade.php
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct'); // the slug (Route Parameter) {id?} is an Optional Parameter, so if it's passed, this means 'Edit/Update the Product', and if not passed, this means' Add a Product'    // GET request to render the add_edit_product.blade.php view, and POST request to submit the <form> in that view
        Route::get('delete-product-image/{id}', 'ProductsController@deleteProductImage'); // Delete a product images (in the three folders: small, medium and large) in add_edit_product.blade.php page from BOTH SERVER (FILESYSTEM) & DATABASE
        Route::get('delete-product-video/{id}', 'ProductsController@deleteProductVideo'); // Delete a product video in add_edit_product.blade.php page from BOTH SERVER (FILESYSTEM) & DATABASE

        // Attributes
        Route::match(['get', 'post'], 'add-edit-attributes/{id}', 'ProductsController@addAttributes'); // GET request to render the add_edit_attributes.blade.php view, and POST request to submit the <form> in that view
        Route::post('update-attribute-status', 'ProductsController@updateAttributeStatus'); // Update Attributes Status using AJAX in add_edit_attributes.blade.php
        Route::get('delete-attribute/{id}', 'ProductsController@deleteAttribute'); // Delete an attribute in add_edit_attributes.blade.php
        Route::match(['get', 'post'], 'edit-attributes/{id}', 'ProductsController@editAttributes'); // in add_edit_attributes.blade.php

        // Images
        Route::match(['get', 'post'], 'add-images/{id}', 'ProductsController@addImages'); // GET request to render the add_edit_attributes.blade.php view, and POST request to submit the <form> in that view
        Route::post('update-image-status', 'ProductsController@updateImageStatus'); // Update Images Status using AJAX in add_images.blade.php
        Route::get('delete-image/{id}', 'ProductsController@deleteImage'); // Delete an image in add_images.blade.php

        // Coupons
        Route::get('coupons', 'CouponsController@coupons'); // Render admin/coupons/coupons.blade.php page in the Admin Panel
        Route::get('delete-coupon/{id}', 'CouponsController@deleteCoupon'); // Delete a Coupon via AJAX in admin/coupons/coupons.blade.php, check admin/js/custom.js

        // Render admin/coupons/add_edit_coupon.blade.php page with 'GET' request ('Edit/Update the Coupon') if the {id?} Optional Parameter is passed, or if it's not passed, it's a GET request too to 'Add a Coupon', or it's a POST request for the HTML Form submission in the same page
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponsController@addEditCoupon'); // the slug (Route Parameter) {id?} is an Optional Parameter, so if it's passed, this means 'Edit/Update the Coupon', and if not passed, this means' Add a Coupon'    // GET request to render the add_edit_coupon.blade.php view (whether Add or Edit depending on passing or not passing the Optional Parameter {id?}), and POST request to submit the <form> in that same page

        // Users
        Route::get('users', 'UserController@users'); // Render admin/users/users.blade.php page in the Admin Panel
        Route::post('update-user-status', 'UserController@updateUserStatus');

        // Orders
        // Render admin/orders/orders.blade.php page (Orders Management section) in the Admin Panel
        Route::get('orders', 'OrderController@orders');

        // Render admin/orders/order_details.blade.php (View Order Details page) when clicking on the View Order Details icon in admin/orders/orders.blade.php (Orders tab under Orders Management section in Admin Panel)
        Route::get('orders/{id}', 'OrderController@orderDetails');

        // Update Order Status (which is determined by 'admin'-s ONLY, not 'vendor'-s, in contrast to "Update Item Status" which can be updated by both 'vendor'-s and 'admin'-s) (Pending, Shipped, In Progress, Canceled, ...) in admin/orders/order_details.blade.php in Admin Panel
        // Note: The `order_statuses` table contains all kinds of order statuses (that can be updated by 'admin'-s ONLY in `orders` table) like: pending, in progress, shipped, canceled, ...etc. In `order_statuses` table, the `name` column can be: 'New', 'Pending', 'Canceled', 'In Progress', 'Shipped', 'Partially Shipped', 'Delivered', 'Partially Delivered' and 'Paid'. 'Partially Shipped': If one order has products from different vendors, and one vendor has shipped their product to the customer while other vendor (or vendors) didn't!. 'Partially Delivered': if one order has products from different vendors, and one vendor has shipped and DELIVERED their product to the customer while other vendor (or vendors) didn't!    // The `order_item_statuses` table contains all kinds of order statuses (that can be updated by both 'vendor'-s and 'admin'-s in `orders_products` table) like: pending, in progress, shipped, canceled, ...etc.
        Route::post('update-order-status', 'OrderController@updateOrderStatus');

        // Update Item Status (which can be determined by both 'vendor'-s and 'admin'-s, in contrast to "Update Order Status" which is updated by 'admin'-s ONLY, not 'vendor'-s) (Pending, In Progress, Shipped, Delivered, ...) in admin/orders/order_details.blade.php in Admin Panel
        // Note: The `order_statuses` table contains all kinds of order statuses (that can be updated by 'admin'-s ONLY in `orders` table) like: pending, in progress, shipped, canceled, ...etc. In `order_statuses` table, the `name` column can be: 'New', 'Pending', 'Canceled', 'In Progress', 'Shipped', 'Partially Shipped', 'Delivered', 'Partially Delivered' and 'Paid'. 'Partially Shipped': If one order has products from different vendors, and one vendor has shipped their product to the customer while other vendor (or vendors) didn't!. 'Partially Delivered': if one order has products from different vendors, and one vendor has shipped and DELIVERED their product to the customer while other vendor (or vendors) didn't!    // The `order_item_statuses` table contains all kinds of order statuses (that can be updated by both 'vendor'-s and 'admin'-s in `orders_products` table) like: pending, in progress, shipped, canceled, ...etc.
        Route::post('update-order-item-status', 'OrderController@updateOrderItemStatus');

        // Orders Invoices
        // Render order invoice page (HTML) in order_invoice.blade.php
        Route::get('orders/invoice/{id}', 'OrderController@viewOrderInvoice');

        // Shipping Charges module
        // Render the Shipping Charges page (admin/shipping/shipping_charges.blade.php) in the Admin Panel for 'admin'-s only, not for vendors
        Route::get('shipping-charges', 'ShippingController@shippingCharges');

        // Update Shipping Status (active/inactive) via AJAX in admin/shipping/shipping_charages.blade.php, check admin/js/custom.js
        Route::post('update-shipping-status', 'ShippingController@updateShippingStatus');

        // Render admin/shipping/edit_shipping_charges.blade.php page in case of HTTP 'GET' request ('Edit/Update Shipping Charges'), or hadle the HTML Form submission in the same page in case of HTTP 'POST' request
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


// Second: FRONT section routes:
Route::namespace('App\Http\Controllers\Front')->group(function () {
    Route::get('/', 'IndexController@index');


    // Dynamic Routes for the `url` column in the `categories` table using a foreach loop    // Listing/Categories Routes
    // Important Note: When you run this Laravel project for the first time and if you're running  the "php artisan migrate" command for the first time, before that you must comment out the $catUrls variable and the following foreach loop in web.php file (routes file), because when we run that artisan command, by then the `categories` table has not been created yet, and this causes an error, so make sure to comment out this code in web.php file before running the "php artisan migrate" command for the first time.
    $catUrls = \App\Models\Category::select('url')->get()->pluck('url')->toArray(); // Routes like: /men, /women, /shirts, ...
    // dd($catUrls);
    foreach ($catUrls as $key => $url) {
        // Important Note: When you run this Laravel project for the first time and if you're running  the "php artisan migrate" command for the first time, before that you must comment out the $catUrls variable and the following foreach loop in web.php file (routes file), because when we run that artisan command, by then the `categories` table has not been created yet, and this causes an error, so make sure to comment out this code in web.php file before running the "php artisan migrate" command for the first time.
        Route::match(['get', 'post'], '/' . $url, 'ProductsController@listing'); // used match() for the HTTP 'GET' requests to render listing.blade.php page and the HTTP 'POST' method for the AJAX request of the Sorting Filter or the HTML Form submission and jQuery for the Sorting Filter WITHOUT AJAX, AND ALSO for submitting the Search Form in listing.blade.php    // e.g.    /men    or    /computers    // Important Note: When you run this Laravel project for the first time and if you're running  the "php artisan migrate" command for the first time, before that you must comment out the $catUrls variable and the following foreach loop in web.php file (routes file), because when we run that artisan command, by then the `categories` table has not been created yet, and this causes an error, so make sure to comment out this code in web.php file before running the "php artisan migrate" command for the first time.
    }


    // Vendor Login/Register
    Route::get('vendor/login-register', 'VendorController@loginRegister'); // render vendor login_register.blade.php page

    // Vendor Register
    Route::post('vendor/register', 'VendorController@vendorRegister'); // the register HTML form submission in vendor login_register.blade.php page

    // Render Single Product Detail Page in front/products/detail.blade.php
    Route::get('/product/{id}', 'ProductsController@detail');

    // The AJAX call from front/js/custom.js file, to show the the correct related `price` and `stock` depending on the selected `size` (from the `products_attributes` table)) by clicking the size <select> box in front/products/detail.blade.php
    Route::post('get-product-price', 'ProductsController@getProductPrice');

    // Show all Vendor products in front/products/vendor_listing.blade.php    // This route is accessed from the <a> HTML element in front/products/vendor_listing.blade.php
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

    // Website Search Form (to search for all website products). Check the HTML Form in front/layout/header.blade.php
    Route::get('search-products', 'ProductsController@listing');

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
