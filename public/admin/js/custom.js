$(document).ready(function() {
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#brands').DataTable();
    $('#products').DataTable();
    $('#filters').DataTable();
    $('#coupons').DataTable();            
    $('#users').DataTable();      
    $('#vendors').DataTable();   
    $('#orders').DataTable();            
    $('#shipping').DataTable(); 
    $('.nav-item').removeClass('active');
    $('.nav-link').removeClass('active');

    $('#current_password').keyup(function() {
        // console.log(this);
        var current_password = $(this).val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/check-admin-password', // check the web.php for this route and check the AdminController for the checkAdminPassword() method
            data   : {current_password: current_password}, // A key/value pair that will checked inside the AdminController using Hash::check($data['current_password']) (e.g. current_password: 123456)    // send the the    var current_password    (Check the above variable)
            success: function(resp) {
                // alert(resp);
                if (resp == 'false') {
                    $('#check_password').html('<b style="color: red">Current Password is Incorrect!</b>'); // the <span> element in update_admin_password.blade.php
                } else if (resp == 'true') {
                    $('#check_password').html('<b style="color: green">Current Password is Correct!</b>'); // the <span> element in update_admin_password.blade.php
                }
            },
            error  : function() {alert('Error');}
        });
    });

    // Updating Product status (active/inactive) using AJAX in products.blade.php    
    $(document).on('click', '.updateProductStatus', function() { // '.updateProductStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateProductStatus').on('click', function() {
        var status     = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var product_id = $(this).attr('product_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-product-status', // check the web.php for this route and check the ProductsController for the updateProductStatus() method
            data   : {status: status, product_id: product_id}, // we pass the status and product_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#product-' + product_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#product-' + product_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Attribute status (active/inactive) using AJAX in add_edit_attributes.blade.php    
    $(document).on('click', '.updateAttributeStatus', function() { // '.updateAttributeStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateAttributetatus').on('click', function() {
        var status       = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var attribute_id = $(this).attr('attribute_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-attribute-status', // check the web.php for this route and check the ProductsController for the updateAttributeStatus() method
            data   : {status: status, attribute_id: attribute_id}, // we pass the status and attribute_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#attribute-' + attribute_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#attribute-' + attribute_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Filter status (active/inactive) using AJAX in filters.blade.php    
    $(document).on('click', '.updateFilterStatus', function() { // '.updateFilterStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateFilterstatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var filter_id = $(this).attr('filter_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-filter-status', // check the web.php for this route and check the ProductsController for the updateFilterStatus() method
            data   : {status: status, filter_id: filter_id}, // we pass the status and filter_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Filter Value status (active/inactive) using AJAX in filters_values.blade.php    
    $(document).on('click', '.updateFilterValueStatus', function() { // '.updateFilterValueStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateFilterValuestatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var filter_id = $(this).attr('filter_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-filter-value-status', // check the web.php for this route and check the ProductsController for the updateFilterValueStatus() method
            data   : {status: status, filter_id: filter_id}, // we pass the status and filter_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update Coupon Status (active/inactive) via AJAX in admin/coupons/coupons.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateCouponStatus', function() { // '.updateCouponStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateCouponStatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var coupon_id = $(this).attr('coupon_id'); // Using HTML Custom Attributes



        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-coupon-status', // check the web.php for this route and check the CouponsController for the updateCouponStatus() method
            data   : {status: status, coupon_id: coupon_id}, // we pass the status and coupon_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#coupon-' + coupon_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#coupon-' + coupon_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update User Status (active/inactive) via AJAX in admin/users/users.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateUserStatus', function() { // '.updateUserStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateUserStatus').on('click', function() {
        var status  = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var user_id = $(this).attr('user_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-user-status', // check the web.php for this route and check the UsersController for the updateUserStatus() method
            data   : {status: status, user_id: user_id}, // we pass the status and user_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#user-' + user_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#user-' + user_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update Shipping Status (active/inactive) via AJAX in admin/shipping/shipping_charages.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateShippingStatus', function() { // '.updateUserStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateUserStatus').on('click', function() {
        var status  = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var shipping_id = $(this).attr('shipping_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-shipping-status', // check the web.php for this route and check the ShippingController for the updateShippingStatus() method
            data   : {status: status, shipping_id: shipping_id}, // we pass in the status and shipping_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#shipping-' + shipping_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#shipping-' + shipping_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // This method will be GLOBAL/COMMON and SHARED with many things that are going to be deleted in different pages, but they ALL must have both the HTML custom attributs: module and module_id to use them here to redirect to the relevant proper route (Check down a little bit    window.location = ....)
    // Confirm Deletion using SweetAlert JavaScript package/plugin
    // Delete category image in add_edit_category.blade.php
    // $('.confirmDelete').click(function() {
    $(document).on('click', '.confirmDelete', function() { // correcting the issue of .confirmDelete (Delete button is not working) is not working when going to the next page (using pagination)
        var module   = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');


        // After the CDNs block in the country, I resorted to this solution:
        if (confirm('Are you sure you want to delete this?')) {
            window.location = '/admin/delete-' + module + '/' + moduleid;
        } else {
            return false; 
        }
    });

    // Add Remove Input Fields Dynamically using jQuery: https://www.codexworld.com/add-remove-input-fields-dynamically-using-jquery/    
    // Products attributes add//remove input fields dynamically using jQuery
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height:10px"></div><input type="text" name="sku[]" placeholder="SKU" style="width:100px">&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width:100px">&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        // Check maximum number of input fields
        if(x < maxField){ 
            x++; // Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); // Remove field html
        x--; // Decrement field counter
    });



    // Show the related filters depending on the selected category in category_filters.blade.php (which in turn is included by add_edit_product.php) using AJAX
    $('#category_id').on('change', function() {
        var category_id = $(this).val(); // the category_id of the selected category

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : 'category-filters', // check this route in web.php
            data   : {category_id: category_id},
            success: function(resp) {
                $('.loadFilters').html(resp.view);
            }
        });
    });



    // Show/Hide Coupon fields for Coupon Options (Manual/Automatic) in admin/coupons/add_edit_coupon.blade.php    
    $('#ManualCoupon').click(function() {
        $('#couponField').show();
    });
    $('#AutomaticCoupon').click(function() {
        $('#couponField').hide();
    });



    // Hide Courier Name and Tracking Number HTML input fields in admin/orders/order_details.blade.php in "Update Order Status" Section, and show them ONLY if the "Update Order Status" <select><option> (dropdown menu) is updated/changed (to 'Shipped' only) by an 'admin'    
    $('#courier_name').hide();
    $('#tracking_number').hide();
    $('#order_status').on('change', function() {
        if (this.value == 'Shipped') { // is the same as:    if ($(this).val() == 'Shipped') {
            $('#courier_name').show();
            $('#tracking_number').show();
        } else {
            $('#courier_name').hide();
            $('#tracking_number').hide();
        }
    });

}); // End of $(document).ready()