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
                                @foreach ($newProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
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
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>Baru</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane show fade" id="men-best-selling-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($bestSellers as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
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
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>Baru</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discounted-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($discountedProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
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
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>Baru</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="men-featured-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($featuredProducts as $product)
                                @php
                                $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
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
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                                        @endphp
                                        @if ($getDiscountPrice > 0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $getDiscountPrice }}
                                            </div>
                                            <div class="item-old-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                IDR {{ $product['product_price'] }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tag new">
                                        <span>Baru</span>
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