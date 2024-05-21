<script>
    // Note: We must use a <script> tag to write JavaScript because this file has a .php extension
    // Using jQuery for the website FRONT section:
    $(document).ready(function() {

        // Sorting Filter WITHOUT AJAX (using HTML <form> and jQuery) in front/products/listing.blade.php    



        // Sorting Filter WITH AJAX in front/products/listing.blade.php. Check ajax_products_listing.blade.php (which is 'include'-ed by listing.blade.php page)    
        $('#sort').on('change', function() { // selecting the <selec> box in listing.blade.php
            var sort = $('#sort').val(); // Get the <select> box value of the 'sort' name HTML attribute
            var url = $('#url')
                .val(); // Get the <input> field value of the 'url' name HTML attribute ($url is passed from listing() method in Front/ProductsController.php to view (lising.blade.php))


            // Send all the 'fabric' Dynamic Filter values (the ':checked' checkboxes <input> fields values in filters.blade.php) along with the Sorting Filters 'sort'    


            var size = get_filter(
                'size'
            ); // get all the ':checked' checkboxes (the 'size' filter values) in filters.blade.php    // get the filter values array of 'size' filter like    ['small', 'medium', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var color = get_filter(
                'color'
            ); // get all the ':checked' checkboxes (the 'color' filter values) in filters.blade.php    // get the filter values array of 'color' filter like    ['red', 'blue', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var price = get_filter(
                'price'
            ); // get all the ':checked' checkboxes (the 'price' filter values) in filters.blade.php    // get the filter values array of 'price' filter like    ['1000-2000', '2000-5000', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var brand = get_filter(
                'brand'
            ); // get all the ':checked' checkboxes (the 'brand' filter values) in filters.blade.php    // get the filter values array of 'brand' filter like    ['Concrete', 'Adidas', ...]    as an ARRAY    // get_filter() is in front/js/custom.js


            // Send all the Dynamic Filter values DYNAMICALLY (the ':checked' checkboxes <input> fields values in filters.blade.php) along with the Sorting Filters 'sort'    
            // When a Sorting Filter is clicked, get all the Dynamic Filters's filter values to send them too with the AJAX call, along with sort and url



        });

        // operate Dynamic Filters statically using the first way (for the 'fabric' filter only): // Check get_filter() function in this file and the listing() method in Front/ProductsController.php
        // We will need to send the 'url' and 'sort' to include them too just like we did with the Sorting Filter function above (in this file) (along with sending 'fabric')

        // operate Dynamic Filters DYNAMICALLY using the SECOND way (for ALL filters): // Check get_filter() function in front/js/custom.js and the listing() method in Front/ProductsController.php    
        // We will need to send the 'url' and 'sort' to include them too just like we did with the Sorting Filter function above (in this file) (along with sending 'fabric')
        // WHEN ANY FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!



        // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
        // First: the 'size' filter (from `products_attributes` database table)
        // WHEN the 'size' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'size' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!
        $('.size').on('click', function() { // select the 'size' filter in filters.blade.php
            var url = $('#url')
                .val(); // from the <select> box in listing.blade.php page (which, in turn, includes filters.blade.php page)
            var sort = $('#sort option:selected')
                .val(); // select the :selected <option> element ONLY which is :selected in listing.blade.php (which, in turn, includes filters.blade.php) (like 'price_highest', 'name_z_a', ...)    // https://www.w3schools.com/jquery/sel_input_selected.asp    // .text() https://www.w3schools.com/jquery/html_text.asp    // send the Sorting Filters values (sort) along with the Dynamic Filters values ('fabric' Dynamic Filter values)


            var size = get_filter(
                'size'
            ); // get all the ':checked' checkboxes (the 'size' filter values) in filters.blade.php    // get the filter values array of 'size' filter like    ['small', 'medium', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var color = get_filter(
                'color'
            ); // get all the ':checked' checkboxes (the 'color' filter values) in filters.blade.php    // get the filter values array of 'color' filter like    ['red', 'blue', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var price = get_filter(
                'price'
            ); // get all the ':checked' checkboxes (the 'price' filter values) in filters.blade.php    // get the filter values array of 'price' filter like    ['1000-2000', '2000-5000', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var brand = get_filter(
                'brand'
            ); // get all the ':checked' checkboxes (the 'brand' filter values) in filters.blade.php    // get the filter values array of 'brand' filter like    ['Concrete', 'Adidas', ...]    as an ARRAY    // get_filter() is in front/js/custom.js



            // WHEN the 'size' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'size' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!

        });


        // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
        // Second: the 'color' filter (from `products` database table)
        // WHEN the 'color' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'color' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!
        $('.color').on('click', function() { // select the 'color' filter in filters.blade.php
            var url = $('#url')
                .val(); // from the <select> box in listing.blade.php page (which, in turn, includes filters.blade.php page)
            var sort = $('#sort option:selected')
                .val(); // select the :selected <option> element ONLY which is :selected in listing.blade.php (which, in turn, includes filters.blade.php) (like 'price_highest', 'name_z_a', ...)    // https://www.w3schools.com/jquery/sel_input_selected.asp    // .text() https://www.w3schools.com/jquery/html_text.asp    // send the Sorting Filters values (sort) along with the Dynamic Filters values ('fabric' Dynamic Filter values)

            var size = get_filter(
                'size'
            ); // get all the ':checked' checkboxes (the 'size' filter values) in filters.blade.php    // get the filter values array of 'size' filter like    ['small', 'medium', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var color = get_filter(
                'color'
            ); // get all the ':checked' checkboxes (the 'color' filter values) in filters.blade.php    // get the filter values array of 'color' filter like    ['red', 'blue', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var price = get_filter(
                'price'
            ); // get all the ':checked' checkboxes (the 'price' filter values) in filters.blade.php    // get the filter values array of 'price' filter like    ['1000-2000', '2000-5000', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var brand = get_filter(
                'brand'
            ); // get all the ':checked' checkboxes (the 'brand' filter values) in filters.blade.php    // get the filter values array of 'brand' filter like    ['Concrete', 'Adidas', ...]    as an ARRAY    // get_filter() is in front/js/custom.js



            // WHEN the 'color' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'color' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!

        });


        // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
        // Third: the 'price' filter (from `products` database table)
        // WHEN the 'price' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'price' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!
        $('.price').on('click', function() { // select the 'price' filter in filters.blade.php
            var url = $('#url')
                .val(); // from the <select> box in listing.blade.php page (which, in turn, includes filters.blade.php page)
            var sort = $('#sort option:selected')
                .val(); // select the :selected <option> element ONLY which is :selected in listing.blade.php (which, in turn, includes filters.blade.php) (like 'price_highest', 'name_z_a', ...)    // https://www.w3schools.com/jquery/sel_input_selected.asp    // .text() https://www.w3schools.com/jquery/html_text.asp    // send the Sorting Filters values (sort) along with the Dynamic Filters values ('fabric' Dynamic Filter values)

            var size = get_filter(
                'size'
            ); // get all the ':checked' checkboxes (the 'size' filter values) in filters.blade.php    // get the filter values array of 'size' filter like    ['small', 'medium', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var color = get_filter(
                'color'
            ); // get all the ':checked' checkboxes (the 'color' filter values) in filters.blade.php    // get the filter values array of 'color' filter like    ['red', 'blue', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var price = get_filter(
                'price'
            ); // get all the ':checked' checkboxes (the 'price' filter values) in filters.blade.php    // get the filter values array of 'price' filter like    ['1000-2000', '2000-5000', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var brand = get_filter(
                'brand'
            ); // get all the ':checked' checkboxes (the 'brand' filter values) in filters.blade.php    // get the filter values array of 'brand' filter like    ['Concrete', 'Adidas', ...]    as an ARRAY    // get_filter() is in front/js/custom.js


            // WHEN the 'price' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'price' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!

        });


        // Size, price, color, brand, … are also Dynamic Filters, but won't be managed like the other Dynamic Filters, but we will manage every filter of them from the suitable respective database table, like the 'size' Filter from the `products_attributes` database table, 'color' Filter and `price` Filter from `products` table, 'brand' Filter from `brands` table
        // Fourth: the 'brand' filter (from `products` and `brands` database tables)
        // WHEN the 'brand' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'brand' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!
        $('.brand').on('click', function() { // select the 'brand' filter in filters.blade.php
            var url = $('#url')
                .val(); // from the <select> box in listing.blade.php page (which, in turn, includes filters.blade.php page)
            var sort = $('#sort option:selected')
                .val(); // select the :selected <option> element ONLY which is :selected in listing.blade.php (which, in turn, includes filters.blade.php) (like 'brand_highest', 'name_z_a', ...)    // https://www.w3schools.com/jquery/sel_input_selected.asp    // .text() https://www.w3schools.com/jquery/html_text.asp    // send the Sorting Filters values (sort) along with the Dynamic Filters values ('fabric' Dynamic Filter values)

            var size = get_filter(
                'size'
            ); // get all the ':checked' checkboxes (the 'size' filter values) in filters.blade.php    // get the filter values array of 'size' filter like    ['small', 'medium', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var color = get_filter(
                'color'
            ); // get all the ':checked' checkboxes (the 'color' filter values) in filters.blade.php    // get the filter values array of 'color' filter like    ['red', 'blue', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var price = get_filter(
                'price'
            ); // get all the ':checked' checkboxes (the 'price' filter values) in filters.blade.php    // get the filter values array of 'price' filter like    ['1000-2000', '2000-5000', ...]    as an ARRAY    // get_filter() is in front/js/custom.js
            var brand = get_filter(
                'brand'
            ); // get all the ':checked' checkboxes (the 'brand' filter values) in filters.blade.php    // get the filter values array of 'brand' filter like    ['Concrete', 'Adidas', ...]    as an ARRAY    // get_filter() is in front/js/custom.js


            // WHEN the 'brand' FILTER'S FILTER VALUE IS CLICKED, SEND THE CLICKED 'brand' FILTER'S FILTER VALUES ALONG WITH THE OTHER FILTERS' FILTER VALUES TOO!!

        });

        $('#courier').on('change', function() {
            updateShipping();
        });

        $('input[name="address_id"]').on('change', function() {
            updateShipping();
        });
        // console.log($("input[name='address_id']:checked").val());
        // console.log($('#courier').val());
        function selectedCourier() {
            return $('#courier').val() ?? false;
        }

        function checkedAddress() {
            return $("input[name='address_id']:checked").val() ?? false;
        }

        updateShipping()

        function updateShipping() {
            var courier = $('#courier').val(); // Retrieve selected courier value
            var selectedAddress = $('input[name="address_id"]:checked');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
                url: "{{ route('check-ongkir') }}", // this will hit the listing() method in Front/ProductsController.php    // e.g. /men (this url hits the Dynamic Routes in web.php using a foreach loop ('ProductsController@listing'))    // check the web.php for this route and check the ProductsController for the listing() method
                method: 'GET',
                data: {
                    destination: selectedAddress.val(),
                    courier: courier
                },
                success: function(data) {

                    $('#result-courier').empty();
                    $('#result-courier').append(`
                                    <div class="col-12">
                                        <div class="card border rounded shadow">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Pilih</th>
                                                            <th>Service</th>
                                                            <th>Description</th>
                                                            <th>Cost</th>
                                                            <th>ETD</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="resultBody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                `);
                    $.each(data, function(i, val) {

                        $('#resultBody').append(`
                                    <tr>
                                        <td> <input type="radio" id="address-${i}" name="pick_id" shipping_charges="${val.cost[0].value}" ></td>
                                        <td>${val.service}</td>
                                        <td>${val.description}</td>
                                        <td>${val.cost[0].value}</td>
                                        <td>${val.cost[0].etd}</td>
                                    </tr>
                                `);

                    });

                    $('input[name="pick_id"]').each(function(index) {
                        $(this).on('change', function() {

                            if ($(this).is(':checked')) {

                                var shippingCharges = parseFloat($(this).attr(
                                    'shipping_charges'));


                                var grand_total = parseFloat($('#price_static')
                                    .val());
                                var totalPrice = grand_total + shippingCharges;

                                $('.shipping_charges').text(shippingCharges);
                                $('.grand_total').text(totalPrice);
                                document.getElementById('grand_total').value =
                                    totalPrice;
                                document.getElementById('shipping_charges').value =
                                    shippingCharges;
                            }
                        });
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }


    });
</script>
