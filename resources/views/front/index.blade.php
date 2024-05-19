@extends('front.layout.layout')

@section('content')
<?php $message = Session::get('message'); ?>
@if(!is_null($message))
<div class="alert alert-success" role="alert">
    Status Message : {{$message->status_message ?? null}}
    Transaction Status : {{$message->transaction_status ?? null}}
</div>
@endif
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <h3 class="sec-maker-h3">TOP COLLECTION</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#men-latest-products">New Arrivals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Best Sellers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#discounted-products">Discounted Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#men-featured-products">Featured Products</a>
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="men-latest-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">

                                {{-- Show 'New Arrivals'. Show the LATEST 8 products ONLY. Check the index() method in IndexController.php --}}
                                @foreach ($newProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                // dd($product['product_image']);
                                // dd($product_image_path);
                                // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                // dd('Yes');
                                // } else {
                                // dd('No');
                                // }
                                @endphp

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>



                                        {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp


                                        @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else {{-- if there's no discount on the price, show the original price --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif



                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane show fade" id="men-best-selling-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">


                                {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}}
                                @foreach ($bestSellers as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                // dd($product['product_image']);
                                // dd($product_image_path);
                                // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                // dd('Yes');
                                // } else {
                                // dd('No');
                                // }
                                @endphp

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>

                                        {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else {{-- if there's no discount on the price, show the original price --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discounted-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">


                                {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}}
                                @foreach ($discountedProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                // dd($product['product_image']);
                                // dd($product_image_path);
                                // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                // dd('Yes');
                                // } else {
                                // dd('No');
                                // }
                                @endphp

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>

                                        {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else {{-- if there's no discount on the price, show the original price --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="men-featured-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">


                                {{-- Show the 'Best Seller' products. Check the index() method in IndexController.php --}}
                                @foreach ($featuredProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                // dd($product['product_image']);
                                // dd($product_image_path);
                                // if (!empty($product['product_image']) && file_exists($product_image_path)) {
                                // dd('Yes');
                                // } else {
                                // dd('No');
                                // }
                                @endphp

                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path)) {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="{{ url('product/' . $product['id']) }}">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_code'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>

                                        {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else {{-- if there's no discount on the price, show the original price --}}
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                Rs . {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>NEW</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection