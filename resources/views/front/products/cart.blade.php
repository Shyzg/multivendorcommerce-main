@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Keranjang</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Keranjang</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-cart u-s-p-t-80">
    <div class="container">
        @if (Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success:</strong> {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
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
            <strong>Error:</strong> @php echo implode('', $errors->all('<div>:message</div>')); @endphp
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <div id="appendCartItems">
                    @include('front.products.cart_items')
                </div>
                <div class="coupon-continue-checkout u-s-m-b-60">
                    <div class="coupon-area">
                        <div class="coupon-field">
                            <form id="applyCoupon" method="post" action="javascript:void(0)" @if (\Illuminate\Support\Facades\Auth::check()) user=1 @endif>
                                <label class="sr-only" for="coupon-code">Gunakan Kupon</label>
                                <input type="text" class="text-field" placeholder="Masukkan Kode Kupon" id="code" name="code">
                                <button type="submit" class="button">Gunakan Kupon</button>
                            </form>
                        </div>
                    </div>
                    <div class="button-area">
                        <a href="{{ url('/') }}" class="continue">Lanjutkan Belanja</a>
                        <a href="{{ url('/checkout') }}" class="checkout">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection