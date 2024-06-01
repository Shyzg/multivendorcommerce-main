@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Checkout</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/'); }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="cart.html">Checkout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-checkout u-s-p-t-80">
    <div class="container">
        @if (Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-lg-6" id="deliveryAddresses">
                        @include('front.products.delivery_addresses')
                    </div>
                    <div class="col-lg-6">
                        <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">
                            @csrf
                            @if (count($deliveryAddresses) > 0)
                            <h4 class="section-h4">Delivery Addresses</h4>
                            @foreach ($deliveryAddresses as $address)
                            <div class="control-group" style="float: left; margin-right: 5px">
                                <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}" shipping_charges="{{ $address['shipping_charges'] }}" total_price="{{ $total_price }}" checked>
                            </div>
                            <div>
                                <label class="control-label" for="address{{ $address['id'] }}">
                                    {{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }},
                                    {{ $address['state'] }}, {{ $address['country'] }}
                                    ({{ $address['mobile'] }})
                                </label>
                                <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="removeAddress" style="float: right; margin-left: 10px">Remove</a>
                                <a href="javascript:;" data-addressid="{{ $address['id'] }}" class="editAddress" style="float: right">Edit</a>
                            </div>
                            @endforeach
                            <br>
                            @endif
                            <h4 class="section-h4">Pick Courier</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <div class="col-md-12">
                                        <div class="select-box-wrapper">
                                            <select class="select-box" name="courier" id="courier">
                                                <option>Choose Courier</option>
                                                <option value="jne" selected="selected">JNE</option>
                                                <option value="pos">POS</option>
                                                <option value="tiki">TIKI</option>
                                            </select>
                                        </div>
                                    </div>
                                </table>
                            </div>
                            <h4 class="section-h4">Chooes PickUp</h4>
                            <div class="order-table">
                                <div id="result-courier"></div>
                            </div>
                            <h4 class="section-h4">Your Order</h4>
                            <div class="order-table">
                                <table class="u-s-m-b-13">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total_price = 0 @endphp
                                        @foreach ($getCartItems as $item)
                                        @php
                                        $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice(
                                        $item['product_id'],
                                        );
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="{{ url('product/' . $item['product_id']) }}">
                                                    <img width="50px" src="{{ asset('front/images/product_images/small/' . $item['product']['product_image']) }}" alt="Product">
                                                    <h6 class="order-h6">{{ $item['product']['product_name'] }}
                                                    </h6>
                                                </a>
                                                <span class="order-span-quantity">x {{ $item['quantity'] }}</span>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">
                                                    IDR
                                                    {{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}
                                                </h6>
                                            </td>
                                        </tr>
                                        @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
                                        @endforeach
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Subtotal</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">IDR {{ $total_price }}</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Shipping Charges</h6>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">
                                                    <input class="text-field" type="hidden" id="shipping_charges" name="shipping_charges" value="">
                                                    <span class="shipping_charges"></span>
                                                </h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="order-h6">Coupon Discount</h6>
                                            </td>
                                            <td>
                                                <h6 class="order-h6">
                                                    @if (\Illuminate\Support\Facades\Session::has('couponAmount'))
                                                    <span class="couponAmount">IDR
                                                        {{ \Illuminate\Support\Facades\Session::get('couponAmount') }}</span>
                                                    @else
                                                    IDR 0
                                                    @endif
                                                </h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="order-h3">Grand Total</h3>
                                            </td>
                                            <td>
                                                <h3 class="order-h3">
                                                    <input class="text-field" type="hidden" id="price_static" name="price" value="{{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount') }}">
                                                    <input class="text-field" type="hidden" id="grand_total" name="grand_total" value="">
                                                    <strong class="grand_total"></strong>
                                                </h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="u-s-m-b-13 prepaidMethod">
                                    <input type="radio" class="radio-box" name="payment_gateway" id="midtrans" value="midtrans">
                                    <label class="label-text" for="midtrans">Midtrans</label>
                                </div>
                                <button type="submit" id="placeOrder" class="button button-outline-secondary">Place Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection