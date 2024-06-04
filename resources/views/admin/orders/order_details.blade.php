@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
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
            <strong>Success:</strong> {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Pesanan</h4>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Order ID: </label>
                            <label>#{{ $orderDetails->id }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Tanggal Pemesanan: </label>
                            <label>{{ $orderDetails->created_at->format('l, d F Y H:i:s a') }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Total Pesanan: </label>
                            <label>IDR {{ $orderDetails->grand_total }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Ongkos Kirim: </label>
                            <label>IDR {{ $orderDetails->shipping_charges }}</label>
                        </div>
                        @if (!empty($orderDetails->coupon_code))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Kode Kupon: </label>
                            <label>{{ $orderDetails->coupon_code }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Potongan Harga Kupon: </label>
                            <label>IDR {{ $orderDetails->coupon_amount }}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Metode Pembayaran</label>
                            <label>{{ $orderDetails->payment_gateway }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Pembeli</h4>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Nama: </label>
                            <label>{{ $userDetails->name }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Nomor Handphone: </label>
                            <label>{{ $userDetails->mobile }}</label>
                        </div>
                        @if (!empty($userDetails->address))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Alamat: </label>
                            <label>{{ $userDetails->address }}</label>
                        </div>
                        @endif
                        @if (!empty($userDetails->country))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Negara: </label>
                            <label>{{ $userDetails->country }}</label>
                        </div>
                        @endif
                        @if (!empty($userDetails->state))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Provinsi: </label>
                            <label>{{ $userDetails->state }}</label>
                        </div>
                        @endif
                        @if (!empty($userDetails->city))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Kota: </label>
                            <label>{{ $userDetails->city }}</label>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Alamat Pengiriman</h4>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Nama: </label>
                            <label>{{ $orderDetails->name }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Nomor Handphone: </label>
                            <label>{{ $orderDetails->mobile }}</label>
                        </div>
                        @if (!empty($orderDetails->address))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Alamat: </label>
                            <label>{{ $orderDetails->address }}</label>
                        </div>
                        @endif
                        @if (!empty($orderDetails->country))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Negara: </label>
                            <label>{{ $orderDetails->country }}</label>
                        </div>
                        @endif
                        @if (!empty($orderDetails->state))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Provinsi: </label>
                            <label>{{ $orderDetails->state }}</label>
                        </div>
                        @endif
                        @if (!empty($orderDetails->city))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Kota: </label>
                            <label>{{ $orderDetails->city }}</label>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Produk Pesanan</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <tr class="table-primary">
                                    <th>Foto Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Kuantitas</th>
                                </tr>
                                @foreach ($order->orders_products as $orderProduct)
                                @if ($orderProduct->vendor_id == $vendor_id)
                                <tr>
                                    <td>
                                        @php
                                        $getProductImage = \App\Models\Product::getProductImage($orderProduct->product_id);
                                        @endphp
                                        <a target="_blank" href="{{ url('product/' . $orderProduct->product_id) }}">
                                            <img src="{{ asset('front/images/product_images/small/' . $getProductImage) }}">
                                        </a>
                                    </td>
                                    <td>{{ $orderProduct->product->product_name }}</td>
                                    <td>{{ $orderProduct->product->product_price }}</td>
                                    <td>{{ $orderProduct->product_qty }}</td>
                                    <!-- <td>
                                        <form action="{{ url('admin/update-order-item-status') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="order_item_id" value="{{ $orderProduct->id }}">

                                            <select id="order_item_status" name="order_item_status" required>
                                                <option value="">Select</option>
                                                @foreach ($orderItemStatuses as $status)
                                                <option value="{{ $status['name'] }}" @if (!empty($orderProduct['item_status']) && $orderProduct['item_status']==$status['name']) selected @endif>{{ $status['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <input style="width: 110px" type="text" name="item_courier_name" id="item_courier_name" placeholder="Item Courier Name" @if (!empty($orderProduct['courier_name'])) value="{{ $orderProduct['courier_name'] }}" @endif>
                                            <input style="width: 110px" type="text" name="item_tracking_number" id="item_tracking_number" placeholder="Item Tracking Number" @if (!empty($orderProduct['tracking_number'])) value="{{ $orderProduct['tracking_number'] }}" @endif>
                                            <button type="submit">Update</button>
                                        </form>
                                    </td> -->
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection