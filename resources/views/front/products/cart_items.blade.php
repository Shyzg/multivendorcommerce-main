<div class="table-wrapper u-s-m-b-60">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total_price = 0 @endphp
            @foreach ($getCartItems as $item)
            @php
            $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice($item['product_id']);
            @endphp
            <tr>
                <td>
                    <div class="cart-anchor-image">
                        <a href="{{ url('product/' . $item['product_id']) }}">
                            <img src="{{ asset('front/images/product_images/small/' . $item['product']['product_image']) }}" alt="">
                            <h6>
                                {{ $item['product']['product_name'] }}
                            </h6>
                        </a>
                    </div>
                </td>
                <td>
                    <div class="cart-price">
                        @if ($getDiscountAttributePrice['discount'] > 0)
                        <div class="price-template">
                            <div class="item-new-price">
                                IDR {{ $getDiscountAttributePrice['final_price'] }}
                            </div>
                            <div class="item-old-price" style="margin-left: -40px">
                                IDR {{ $getDiscountAttributePrice['product_price'] }}
                            </div>
                        </div>
                        @else
                        <div class="price-template">
                            <div class="item-new-price">
                                IDR {{ $getDiscountAttributePrice['final_price'] }}
                            </div>
                        </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="cart-quantity">
                        <div class="quantity">
                            <input type="text" class="quantity-text-field" value="{{ $item['quantity'] }}">
                            <a data-max="1000" class="plus-a  updateCartItem" data-cartid="{{ $item['id'] }}" data-qty="{{ $item['quantity'] }}">&#43;</a>
                            <a data-min="1" class="minus-a updateCartItem" data-cartid="{{ $item['id'] }}" data-qty="{{ $item['quantity'] }}">&#45;</a>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="cart-price">
                        IDR {{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}
                    </div>
                </td>
                <td>
                    <div class="action-wrapper">
                        <button class="button button-outline-secondary fas fa-trash deleteCartItem" data-cartid="{{ $item['id'] }}"></button>
                    </div>
                </td>
            </tr>
            @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
            @endforeach
        </tbody>
    </table>
</div>
<div class="calculation u-s-m-b-60">
    <div class="table-wrapper-2">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Cart Totals</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Sub Total</h3>
                    </td>
                    <td>
                        <span class="calc-text">IDR {{ $total_price }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Coupon Discount</h3>
                    </td>
                    <td>
                        <span class="calc-text couponAmount">
                            @if (\Illuminate\Support\Facades\Session::has('couponAmount'))
                            IDR {{ \Illuminate\Support\Facades\Session::get('couponAmount') }}
                            @else
                            IDR 0
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="calc-h3 u-s-m-b-0">Grand Total</h3> {{-- Total Price after Coupon discounts (if any) --}}
                    </td>
                    <td>
                        <span class="calc-text grand_total">IDR {{ $total_price - \Illuminate\Support\Facades\Session::get('couponAmount') }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>