@extends('front.layout.layout')

@section('content')
<style>
    html {
        font-size: 14px;
    }

    @media (min-width: 768px) {
        html {
            font-size: 16px;
        }
    }

    .container {
        max-width: 960px;
    }

    .pricing-header {
        max-width: 700px;
    }

    .card-deck .card {
        min-width: 220px;
    }

    .border-top {
        border-top: 1px solid #e5e5e5;
    }

    .border-bottom {
        border-bottom: 1px solid #e5e5e5;
    }

    .box-shadow {
        box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
    }
</style>
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Pembayaran</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Pembayaran</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container pb-5 pt-5">
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Data Order</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <td>ID</td>
                            <td><b>#{{ $order->id }}</b></td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td><b>Rp {{ number_format($order->grand_total, 2, ',', '.') }}</b></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td><b>{{ $order->created_at->format('l, d F Y H:i:s') }}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Pembayaran</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = '/payments/finish?message=' + encodeURIComponent(JSON
                    .stringify(result));
            },
            onPending: function(result) {
                window.location.href = '/payments/unfinish?message=' + encodeURIComponent(JSON
                    .stringify(result));

            },
            onError: function(result) {
                window.location.href = '/payments/error?message=' + encodeURIComponent(JSON
                    .stringify(result));

            }
        });
    });
</script>
@endsection