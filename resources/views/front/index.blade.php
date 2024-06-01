@extends('front.layout.layout')

@section('content')
<?php $message = Session::get('message'); ?>
@if (!is_null($message))
<div class="alert alert-success" role="alert">
    Status Message : {{ $message->status_message ?? null }}
    Transaction Status : {{ $message->transaction_status ?? null }}
</div>
@endif
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Products</h2>
        </div>
    </div>
</div>
<section class="section-maker">
    <div class="container">
        <div class="sec-maker-header text-center">
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#new">New Arrivals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#best-seller">Best Sellers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#discount">Discounted Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#food-products">Food Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#drink-products">Drink Products</a>
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="new">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($newProducts as $product)
                                @php
                                $product_image_path =
                                'front/images/product_images/small/' . $product['product_image'];
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane show fade" id="best-seller">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($bestSellers as $product)
                                @php
                                $product_image_path =
                                'front/images/product_images/small/' . $product['product_image'];
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
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice(
                                        $product['id'],
                                        );
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discount">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($discountedProducts as $product)
                                @php
                                $product_image_path =
                                'front/images/product_images/small/' . $product['product_image'];
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
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice(
                                        $product['id'],
                                        );
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="food-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($makanan as $product)
                                @php
                                $product_image_path =
                                'front/images/product_images/small/' . $product['product_image'];
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else
                                            {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice(
                                        $product['id'],
                                        );
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="drink-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @foreach ($minuman as $product)
                                @php
                                $product_image_path =
                                'front/images/product_images/small/' . $product['product_image'];
                                @endphp
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                                            @if (!empty($product['product_image']) && file_exists($product_image_path))
                                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                                            @else
                                            {{-- show the dummy image --}}
                                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}" alt="Product">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <h6 class="item-title">
                                                <a href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                            </h6>
                                        </div>
                                        @php
                                        $getDiscountPrice = \App\Models\Product::getDiscountPrice(
                                        $product['id'],
                                        );
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