@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Detail Produk</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="javascript:;">Detail Produk</a>
                </li>
            </ul>
        </div>
    </div>
</div>
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
                        <h6 class="information-heading u-s-m-b-8">Deskripsi</h6>
                        <p>{{ $productDetails['description'] }}</p>
                    </div>
                    <div class="section-3-price-original-discount u-s-p-y-14">
                        @php $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']) @endphp
                        <span class="getAttributePrice">
                            @if ($getDiscountPrice > 0)
                            <div class="price">
                                <h4>IDR {{ $getDiscountPrice }}</h4>
                            </div>
                            <div class="original-price">
                                <span>Harga Normal</span>
                                <span>IDR {{ $productDetails['product_price'] }}</span>
                            </div>
                            @else
                            <div class="price">
                                <h4>IDR {{ $productDetails['product_price'] }}</h4>
                            </div>
                            @endif
                        </span>
                    </div>
                    <div class="section-4-sku-information u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Informasi SKU</h6>
                        <div class="availability">
                            <span>Ketersediaan</span>
                            @if ($totalStock > 0)
                            <span>Tersedia</span>
                            @else
                            <span style="color: red">Habis</span>
                            @endif
                        </div>
                        @if ($totalStock > 0)
                        <div class="left">
                            <span>Stok</span>
                            <span>{{ $totalStock }}</span>
                        </div>
                        @endif
                    </div>
                    @if (isset($productDetails['vendor']))
                    <div>
                        Penjual <a href="/products/{{ $productDetails['vendor']['id'] }}">{{ $productDetails['vendor']['vendorbusinessdetails']['shop_name'] }}</a>
                    </div>
                    @endif
                    <form action="{{ url('cart/add') }}" method="Post" class="post-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                        <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                            <div class="quantity-wrapper u-s-m-b-22">
                                <span>Kuantitas</span>
                                <div class="quantity">
                                    <input class="quantity-text-field" type="number" name="quantity" value="1">
                                </div>
                            </div>
                            <div>
                                <button class="button button-outline-secondary" type="submit">Tambahkan Kedalam
                                    Keranjang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection