@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Shop</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/'); }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="listing.html">Shop</a>
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
                    @if (!isset($_REQUEST['search']))
                    <form name="sortProducts" id="sortProducts">
                        <input type="hidden" name="url" id="url" value="{{ $url }}">
                        <div class="toolbar-sorter">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="sort-by">Sort By</label>
                                <select name="sort" id="sort" class="select-box">
                                    <option value="" selected>Select</option>
                                    <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=='product_latest' ) selected @endif>Sort By: Latest</option>
                                    <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort']=='price_lowest' ) selected @endif>Sort By: Lowest Price</option>
                                    <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort']=='price_highest' ) selected @endif>Sort By: Highest Price</option>
                                    <option value="name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=='name_a_z' ) selected @endif>Sort By: Name A - Z</option>
                                    <option value="name_z_a" @if(isset($_GET['sort']) && $_GET['sort']=='name_z_a' ) selected @endif>Sort By: Name Z - A</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    @endif
                    <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Showing: {{ count($categoryProducts) }}</option>
                                <option value="">Showing: All</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="filter_products">
                    @include('front.products.ajax_products_listing')
                </div>
                @if (!isset($_REQUEST['search']))
                @if (isset($_GET['sort']))
                <div>
                    {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                </div>
                @else
                <div>
                    {{ $categoryProducts->links() }}
                </div>
                @endif
                @endif
                <div>&nbsp;</div>
                <div>{{ $categoryDetails['categoryDetails']['description'] }}</div>
            </div>
        </div>
    </div>
</div>
@endsection