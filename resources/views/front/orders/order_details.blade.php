@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Detail Riwayat Pesanan #{{ $orderDetails->id }}</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('user/orders') }}">Riwayat Pesanan</a>
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
                    <td colspan="2">
                        <strong>Detail Pesanan</strong>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pemesanan</td>
                    <td>{{ $orderDetails->created_at->locale('id_ID')->isoFormat('dddd, D MMMM YYYY H:mm:ss') }}</td>
                </tr>
                <tr>
                    <td>Total Pesanan</td>
                    <td>IDR {{ $orderDetails->grand_total }}</td>
                </tr>
                <tr>
                    <td>Ongkos Kirim</td>
                    <td>IDR {{ $orderDetails->shipping_charges }}</td>
                </tr>
                @if ($orderDetails->coupon_code != '')
                <tr>
                    <td>Kode Kupon</td>
                    <td>{{ $orderDetails->coupon_code }}</td>
                </tr>
                <tr>
                    <td>Potongan Harga Kupon</td>
                    <td>IDR {{ $orderDetails->coupon_amount }}</td>
                </tr>
                @endif
                @if ($orderDetails->courier_name != '')
                <tr>
                    <td>Courier Name</td>
                    <td>{{ $orderDetails->courier_name }}</td>
                </tr>
                <tr>
                    <td>Tracking Number</td>
                    <td>{{ $orderDetails->tracking_number }}</td>
                </tr>
                @endif
                <tr>
                    <td>Status Pesanan</td>
                    <td>{{ $orderDetails->order_status }}</td>
                </tr>
                <tr>
                    <td>Payment Gateway</td>
                    <td>{{ $orderDetails->payment_gateway }}</td>
                </tr>
            </table>
            <table class="table table-striped table-borderless">
                <tr class="table-primary">
                    <th>Foto Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Kuantitas</th>
                    <th>Status</th>
                </tr>
                @foreach ($orderDetails->orders_products as $product)
                <tr>
                    <td>
                        @php
                        $getProductImage = \App\Models\Product::getProductImage($product->product_id);
                        @endphp
                        <a target="_blank" href="{{ url('product/' . $product->product_id) }}">
                            <img style="width: 80px" src="{{ asset('front/images/product_images/small/' . $getProductImage) }}">
                        </a>
                    </td>
                    <td>{{ $product->product->product_name }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_qty }}</td>
                    <td>{{ $product->item_status }}</td>
                </tr>
                @if ($product->courier_name != '')
                <tr>
                    <td colspan="6">Courier Name: {{ $product->courier_name }}, Tracking Number:
                        {{ $product->tracking_number }}
                    </td>
                </tr>
                @endif
                @endforeach
            </table>
            <table class="table table-striped table-borderless">
                <tr class="table-primary">
                    <td colspan="2">
                        <strong>Alamat Pengiriman</strong>
                    </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>{{ $orderDetails->name }}</td>
                </tr>
                <tr>
                    <td>Nomor Handphone</td>
                    <td>{{ $orderDetails->mobile }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $orderDetails->address }}</td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>{{ $orderDetails->city }}</td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>{{ $orderDetails->state }}</td>
                </tr>
                <tr>
                    <td>Negara</td>
                    <td>{{ $orderDetails->country }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection