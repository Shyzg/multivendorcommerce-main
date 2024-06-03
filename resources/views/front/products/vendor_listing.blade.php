@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>{{ $getVendorShop }}</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">{{ $getVendorShop }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-shop u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="">
                    @include('front.products.vendor_products_listing')
                </div>
                <div>
                    {{ $vendorProducts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection