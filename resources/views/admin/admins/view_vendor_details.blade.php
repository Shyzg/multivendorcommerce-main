@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Penjual</h4>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="{{ $vendorDetails['vendor_personal']['email'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_name">Nama Penjual</label>
                            <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['name'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_mobile">Nomor Handphone Penjual</label>
                            <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['mobile'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Alamat Penjual</label>
                            <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['address'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_country">Negara</label>
                            <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['country'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_state">Provinsi</label>
                            <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['state'] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_city">Kota</label>
                            <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['city'] }}" readonly>
                        </div>
                        @if (!empty($vendorDetails['image']))
                        <div class="form-group">
                            <label for="vendor_image">Vendor Photo</label>
                            <br>
                            <img style="width: 200px" src="{{ url('admin/images/photos/' . $vendorDetails['image']) }}">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Toko</h4>
                        <div class="form-group">
                            <label for="vendor_name">Nama Toko</label>
                            <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_name'])) value="{{ $vendorDetails['vendor_business']['shop_name'] }}" @endif readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_mobile">Nomor Handphone Toko</label>
                            <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_mobile'])) value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" @endif readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Alamat Toko</label>
                            <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_address'])) value="{{ $vendorDetails['vendor_business']['shop_address'] }}" @endif readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_country">Negara</label>
                            <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_country'])) value="{{ $vendorDetails['vendor_business']['shop_country'] }}" @endif readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_state">Provinsi</label>
                            <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_state'])) value="{{ $vendorDetails['vendor_business']['shop_state'] }}" @endif readonly>
                        </div>
                        <div class="form-group">
                            <label for="vendor_city">Kota</label>
                            <input type="text" class="form-control" @if (isset($vendorDetails['vendor_business']['shop_city'])) value="{{ $vendorDetails['vendor_business']['shop_city'] }}" @endif readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection