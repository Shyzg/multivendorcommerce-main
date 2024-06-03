@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/'); }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Riwayat Pemesanan</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">
            <table class="table table-striped table-borderless">
                <tr class="table-danger">
                    <th>ID Pembelian</th>
                    <th>Produk Pembelian</th>
                    <th>Payment Method</th>
                    <th>Grand Total</th>
                    <th>Pada</th>
                    @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="{{ url('user/orders/' . $order['id']) }}">{{ $order['id'] }}</a>
                    </td>
                    <td>
                        @foreach ($order['orders_products'] as $product)
                        {{ $product['product_name'] }}
                        <br>
                        @endforeach
                    </td>
                    <td>{{ $order['payment_method'] }}</td>
                    <td>{{ $order['grand_total'] }}</td>
                    <td>{{ date('l, d F Y H:i:s', strtotime($order['created_at'])) }}</td>
                </tr>
                @endforeach
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection