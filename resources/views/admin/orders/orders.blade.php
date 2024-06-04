@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pesanan</h4>
                        <div class="table-responsive pt-3">
                            <table id="orders" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Produk Pesanan</th>
                                        <th>Total</th>
                                        <th>Payment Gateway</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->created_at->locale('id_ID')->isoFormat('dddd, D MMMM YYYY H:mm:ss') }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>
                                            @foreach ($order->orders_products as $orderProduct)
                                            {{ $orderProduct->product->product_name }} ({{ $orderProduct->product_qty }})
                                            <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>{{ $order->payment_gateway }}</td>
                                        <td>
                                            <a href="{{ url('admin/orders/' . $order['id']) }}" class="btn btn-outline-primary">Lihat Detail Pesanan</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection