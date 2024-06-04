@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Riwayat Pesanan</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/'); }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Riwayat Pesanan</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">
            <table class="table table-striped table-borderless">
                <tr class="table-primary">
                    <th>ID Pembelian</th>
                    <th>Produk Pembelian</th>
                    <th>Payment Gateway</th>
                    <th>Grand Total</th>
                    <th>Pada</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="{{ url('user/orders/' . $order->id) }}">{{ $order->id }}</a>
                    </td>
                    <td>
                        @foreach ($order->orders_products as $orderProduct)
                        {{ $orderProduct->product->product_name }}
                        <br>
                        @endforeach
                    </td>
                    <td>{{ $order->payment_gateway }}</td>
                    <td>{{ $order->grand_total }}</td>
                    <td>{{ $order->created_at->locale('id_ID')->isoFormat('dddd, D MMMM YYYY H:mm:ss') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection