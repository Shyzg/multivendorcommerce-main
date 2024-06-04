@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        @if ($slug == 'personal')
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Penjual</h4>
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
                        <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendor_name">Nama Penjual</label>
                                <input type="text" class="form-control" id="vendor_name" placeholder="Masukkan Nama Lengkap Pemilik Toko" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_mobile">Nomor Handphone Penjual</label>
                                <input type="text" class="form-control" id="vendor_mobile" placeholder="Masukkan Nomor Handphone Pemilik Toko" name="vendor_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="10" minlength="10">
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Alamat Penjual</label>
                                <input type="text" class="form-control" id="vendor_address" placeholder="Masukkan Alamat Pemilik Toko" name="vendor_address" value="{{ $vendorDetails['address'] }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_country">Negara</label>
                                <select class="form-control" id="vendor_country" name="vendor_country" style="color: #495057">
                                    <option value="">Negara</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country['name'] }}" @if ($country['name']==$vendorDetails['country']) selected @endif>{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vendor_state">Provinsi</label>
                                <select class="form-control" id="vendor_state" name="vendor_state" style="color: #495057">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $state)
                                    <option value="{{ $state['name'] }}" @if ($state['name']==$vendorDetails['state']) selected @endif>{{ $state['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">Kota</label>
                                <select class="form-control" id="vendor_city" name="vendor_city" style="color: #495057">
                                    <option value="">Pilih Kota</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city['name'] }}" @if ($city['name']==$vendorDetails['city']) selected @endif>{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vendor_image">Foto Profil</label>
                                <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                @if (!empty(Auth::guard('admin')->user()->image))
                                <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($slug == 'business')
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Toko</h4>
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
                        <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="shop_name">Nama Toko</label>
                                <input type="text" class="form-control" id="shop_name" placeholder="Masukkan Nama Toko" name="shop_name" @if (isset($vendorDetails['shop_name'])) value="{{ $vendorDetails['shop_name'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Nomor Handphone Toko</label>
                                <input type="text" class="form-control" id="shop_mobile" placeholder="Masukkan Nomor Handphone Toko" name="shop_mobile" @if (isset($vendorDetails['shop_mobile'])) value="{{ $vendorDetails['shop_mobile'] }}" @endif maxlength="13" minlength="10">
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Alamat Toko</label>
                                <input type="text" class="form-control" id="shop_address" placeholder="Masukkan Alamat Toko" name="shop_address" @if (isset($vendorDetails['shop_address'])) value="{{ $vendorDetails['shop_address'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Negara</label>
                                <select class="form-control" id="shop_country" name="shop_country" style="color: #495057">
                                    @foreach ($countries as $country)
                                    <option value="{{ $country['name'] }}" @if (isset($vendorDetails['shop_country']) && $country['name']==$vendorDetails['shop_country']) selected @endif>{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user-state">Provinsi</label>
                                <select class="form-control" id="shop_state" name="shop_state" style="color: #495057">
                                    @foreach ($provinces as $state)
                                    <option value="{{ $state['name'] }}" @if (isset($vendorDetails['shop_state']) && $state['name']==$vendorDetails['shop_state']) selected @endif>{{ $state['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Kota</label>
                                <select class="form-control" id="shop_city" name="shop_city" style="color: #495057">
                                    @foreach ($cities as $city)
                                    <option value="{{ $city['name'] }}" @if (isset($vendorDetails['shop_city']) && $city['name']==$vendorDetails['shop_city']) selected @endif>{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection