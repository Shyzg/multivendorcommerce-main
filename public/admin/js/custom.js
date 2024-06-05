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
        var current_password = $(this).val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            type   : 'post',
            url    : '/admin/check-admin-password', 
            data   : {current_password: current_password}, 
            success: function(resp) {

                if (resp == 'false') {
                    $('#check_password').html('<b style="color: red">Current Password is Incorrect!</b>'); 
                } else if (resp == 'true') {
                    $('#check_password').html('<b style="color: green">Current Password is Correct!</b>'); 
                }
            },
            error  : function() {alert('Error');}
        });
    });

    $(document).on('click', '.confirmDelete', function() { 
        var module   = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');

        if (confirm('Are you sure you want to delete this?')) {
            window.location = '/admin/delete-' + module + '/' + moduleid;
        } else {
            return false; 
        }
    });

    var maxField = 10; 
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper'); 
    var fieldHTML = '<div><div style="height:10px"></div><input type="text" name="sku[]" placeholder="SKU" style="width:100px">&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width:100px">&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; 
    var x = 1; 

    $(addButton).click(function(){

        if(x < maxField){ 
            x++; 
            $(wrapper).append(fieldHTML); 
        }
    });

    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); 
        x--; 
    });

    $('#category_id').on('change', function() {
        var category_id = $(this).val(); 

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            type   : 'post',
            url    : 'category-filters', 
            data   : {category_id: category_id},
            success: function(resp) {
                $('.loadFilters').html(resp.view);
            }
        });
    });

    $('#ManualCoupon').click(function() {
        $('#couponField').show();
    });
    $('#AutomaticCoupon').click(function() {
        $('#couponField').hide();
    });

    $('#courier_name').hide();
    $('#tracking_number').hide();
    $('#order_status').on('change', function() {
        if (this.value == 'Shipped') { 
            $('#courier_name').show();
            $('#tracking_number').show();
        } else {
            $('#courier_name').hide();
            $('#tracking_number').hide();
        }
    });

}); 