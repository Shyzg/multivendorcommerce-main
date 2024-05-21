@extends('front.layout.layout')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        /* position:absolute; */
        position: inherit;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>
<div class="page-detail u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <a href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}">
                        <img src="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" alt="" width="500" height="500" />
                    </a>
                </div>
                <div class="thumbnails" style="margin-top: 30px">
                    <a href="{{ asset('front/images/product_images/large/' . $productDetails['product_image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}">
                        <img src="{{ asset('front/images/product_images/small/' . $productDetails['product_image']) }}" width="120" height="120" alt="" />
                    </a>
                    @foreach ($productDetails['images'] as $image)
                    <a href="{{ asset('front/images/product_images/large/' . $image['image']) }}" data-standard="{{ asset('front/images/product_images/small/' . $image['image']) }}">
                        <img src="{{ asset('front/images/product_images/small/' . $image['image']) }}" width="120" height="120" alt="" />
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="all-information-wrapper">
                    @if (Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> @php echo Session::get('success_message') @endphp
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="section-1-title-breadcrumb-rating">
                        <div class="product-title">
                            <h1>
                                <a href="javascript:;">{{ $productDetails['product_name'] }}</a>
                            </h1>
                        </div>
                        <ul class="bread-crumb">
                            <li class="has-separator">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="has-separator">
                                <a href="javascript:;">{{ $productDetails['section']['name'] }}</a>
                            </li>
                            @php echo $categoryDetails['breadcrumbs'] @endphp
                        </ul>
                    </div>
                    <div class="section-2-short-description u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Description:</h6>
                        <p>{{ $productDetails['description'] }}</p>
                    </div>
                    <div class="section-3-price-original-discount u-s-p-y-14">
                        @php $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']) @endphp
                        <span class="getAttributePrice">
                            @if ($getDiscountPrice > 0)
                            <div class="price">
                                <h4>EGP{{ $getDiscountPrice }}</h4>
                            </div>
                            <div class="original-price">
                                <span>Original Price:</span>
                                <span>EGP{{ $productDetails['product_price'] }}</span>
                            </div>
                            @else
                            <div class="price">
                                <h4>EGP{{ $productDetails['product_price'] }}</h4>
                            </div>
                            @endif
                        </span>
                    </div>
                    <div class="section-4-sku-information u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                        <div class="availability">
                            <span>Availability:</span>
                            @if ($totalStock > 0)
                            <span>In Stock</span>
                            @else
                            <span style="color: red">Out of Stock (Sold-out)</span>
                            @endif
                        </div>
                        @if ($totalStock > 0)
                        <div class="left">
                            <span>Only:</span>
                            <span>{{ $totalStock }} left</span>
                        </div>
                        @endif
                    </div>
                    @if(isset($productDetails['vendor']))
                    <div>
                        Sold by: <a href="/products/{{ $productDetails['vendor']['id'] }}">
                            {{ $productDetails['vendor']['vendorbusinessdetails']['shop_name'] }}
                        </a>
                    </div>
                    @endif
                    <form action="{{ url('cart/add') }}" method="Post" class="post-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                        <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                            <div class="quantity-wrapper u-s-m-b-22">
                                <span>Quantity:</span>
                                <div class="quantity">
                                    <input class="quantity-text-field" type="number" name="quantity" value="1">
                                </div>
                            </div>
                            <div>
                                <button class="button button-outline-secondary" type="submit">Tambahkan ke keranjang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single-Product-Full-Width-Page /- -->
@endsection