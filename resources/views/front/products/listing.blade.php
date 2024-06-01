@extends('front.layout.layout')

@section('content')
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Shop</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <div class="shop-intro">
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    @php echo $categoryDetails['breadcrumbs']; @endphp
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="page-bar clearfix">
                        <div class="toolbar-sorter-2">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="show-records">Show Records Per Page</label>
                                <select class="select-box" id="show-records">
                                    <option selected="selected" value="">Showing: {{ count($categoryProducts) }}
                                    </option>
                                    <option value="">Showing: All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="filter_products">
                        @include('front.products.ajax_products_listing')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
