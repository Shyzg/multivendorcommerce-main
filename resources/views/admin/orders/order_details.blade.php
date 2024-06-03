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
                        <h4 class="card-title">Detail Pembelian</h4>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Order ID: </label>
                            <label>#{{ $orderDetails['id'] }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Order Date: </label>
                            <label>{{ date('l, d F Y H:i:s a', strtotime($orderDetails['created_at'])) }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Order Total: </label>
                            <label>IDR {{ $orderDetails['grand_total'] }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Shipping Charges: </label>
                            <label>IDR {{ $orderDetails['shipping_charges'] }}</label>
                        </div>
                        @if (!empty($orderDetails['coupon_code']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Coupon Code: </label>
                            <label>{{ $orderDetails['coupon_code'] }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Coupon Amount: </label>
                            <label>IDR {{ $orderDetails['coupon_amount'] }}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Payment Method: </label>
                            <label>{{ $orderDetails['payment_method'] }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Payment Gateway: </label>
                            <label>{{ $orderDetails['payment_gateway'] }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Details</h4>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Name: </label>
                            <label>{{ $userDetails['name'] }}</label>
                        </div>
                        @if (!empty($userDetails['address']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Address: </label>
                            <label>{{ $userDetails['address'] }}</label>
                        </div>
                        @endif
                        @if (!empty($userDetails['city']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">City: </label>
                            <label>{{ $userDetails['city'] }}</label>
                        </div>
                        @endif
                        @if (!empty($userDetails['state']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">State: </label>
                            <label>{{ $userDetails['state'] }}</label>
                        </div>
                        @endif
                        @if (!empty($userDetails['country']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Country: </label>
                            <label>{{ $userDetails['country'] }}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Mobile: </label>
                            <label>{{ $userDetails['mobile'] }}</label>
                        </div>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Email: </label>
                            <label>{{ $userDetails['email'] }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Address</h4>
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Name: </label>
                            <label>{{ $orderDetails['name'] }}</label>
                        </div>
                        @if (!empty($orderDetails['address']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Address: </label>
                            <label>{{ $orderDetails['address'] }}</label>
                        </div>
                        @endif
                        @if (!empty($orderDetails['city']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">City: </label>
                            <label>{{ $orderDetails['city'] }}</label>
                        </div>
                        @endif
                        @if (!empty($orderDetails['state']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">State: </label>
                            <label>{{ $orderDetails['state'] }}</label>
                        </div>
                        @endif
                        @if (!empty($orderDetails['country']))
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Country: </label>
                            <label>{{ $orderDetails['country'] }}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px">
                            <label style="font-weight: 550">Mobile: </label>
                            <label>{{ $orderDetails['mobile'] }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ordered Products</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <tr class="table-danger">
                                    <th>Product Image</th>
                                    <th>Name</th>
                                    <th>Unit Price</th>
                                    <th>Product Qty</th>
                                    <th>Total Price</th>
                                    @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type != 'vendor')
                                    <th>Product by</th>
                                    @endif
                                    <th>Final Amount</th>
                                    <th>Item Status</th>
                                </tr>
                                @foreach ($orderDetails['orders_products'] as $product)
                                <tr>
                                    <td>
                                        @php
                                        $getProductImage = \App\Models\Product::getProductImage(
                                        $product['product_id'],
                                        );
                                        @endphp
                                        <a target="_blank" href="{{ url('product/' . $product['product_id']) }}">
                                            <img src="{{ asset('front/images/product_images/small/' . $getProductImage) }}">
                                        </a>
                                    </td>
                                    <td>{{ $product['product_name'] }}</td>
                                    <td>{{ $product['product_price'] }}</td>
                                    <td>{{ $product['product_qty'] }}</td>
                                    <td>
                                        @if ($product['vendor_id'] > 0)
                                        @if ($orderDetails['coupon_amount'] > 0)
                                        @if (\App\Models\Coupon::couponDetails($orderDetails['coupon_code'])['vendor_id'] > 0)
                                        {{ $total_price = $product['product_price'] * $product['product_qty'] - $item_discount }}
                                        @else
                                        {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                        @endif
                                        @else
                                        {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                        @endif
                                        @else
                                        {{ $total_price = $product['product_price'] * $product['product_qty'] }}
                                        @endif
                                    </td>
                                    @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type != 'vendor')
                                    @if ($product['vendor_id'] > 0)
                                    <td>
                                        <a href="/admin/view-vendor-details/{{ $product['admin_id'] }}" target="_blank">Vendor</a>
                                    </td>
                                    @else
                                    <td>Admin</td>
                                    @endif
                                    @endif
                                    <td>0</td>
                                    <td>{{ $total_price }}</td>
                                    <td>
                                        <form action="{{ url('admin/update-order-item-status') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_item_id" value="{{ $product['id'] }}">
                                            <select id="order_item_status" name="order_item_status" required>
                                                <option value="">Select</option>
                                                @foreach ($orderItemStatuses as $status)
                                                <option value="{{ $status['name'] }}" @if (!empty($product['item_status']) && $product['item_status']==$status['name']) selected @endif>
                                                    {{ $status['name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input style="width: 110px" type="text" name="item_courier_name" id="item_courier_name" placeholder="Item Courier Name" @if (!empty($product['courier_name'])) value="{{ $product['courier_name'] }}" @endif>
                                            <input style="width: 110px" type="text" name="item_tracking_number" id="item_tracking_number" placeholder="Item Tracking Number" @if (!empty($product['tracking_number'])) value="{{ $product['tracking_number'] }}" @endif>
                                            <button type="submit">Update</button>
                                        </form>
                                    </td>
                                </tr>
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