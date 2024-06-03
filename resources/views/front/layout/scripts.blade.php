<script>
    $(document).ready(function() {
        $('#courier').on('change', function() {
            updateShipping();
        });

        $('input[name="address_id"]').on('change', function() {
            updateShipping();
        });

        function selectedCourier() {
            return $('#courier').val() ?? false;
        }

        function checkedAddress() {
            return $("input[name='address_id']:checked").val() ?? false;
        }

        updateShipping()

        function updateShipping() {
            var courier = $('#courier').val();
            var selectedAddress = $('input[name="address_id"]:checked');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('check-ongkir') }}",
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
