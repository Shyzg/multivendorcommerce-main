@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Pemilik Toko</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Account</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="page-account u-s-p-t-80">
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
            <div class="col-lg-6">
                <div class="login-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Masuk Kedalam Akun</h2>
                    <form action="{{ url('admin/login') }}" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="vendor-email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" name="email" id="vendor-email" class="text-field">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendor-password">Kata Sandi
                                <span class="astk">*</span>
                            </label>
                            <input type="password" name="password" id="vendor-password" class="text-field">
                        </div>
                        <div class="m-b-45">
                            <button class="button button-outline-secondary w-100">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Daftar</h2>
                    <form id="vendorForm" action="{{ url('/vendor/register') }}" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="vendorname">Nama
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="vendorname" class="text-field" placeholder="Reza Mahendra" name="name">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendormobile">Nomor Handphone
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="vendormobile" class="text-field" placeholder="081234567890" name="mobile">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendoraddress">Alamat
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="vendoraddress" class="text-field" placeholder="081234567890" name="address">
                            <p id="register-address"></p>
                        </div>
                        <div class="form-group">
                            <label for="vendorcity">Kota</label>
                            <select class="form-control" id="vendorcity" name="city" style="color: #495057">
                                <option value="">Pilih Kota</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vendorstate">Provinsi</label>
                            <select class="form-control" id="vendorstate" name="state" style="color: #495057">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $state)
                                <option value="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vendorcountry">Negara</label>
                            <select class="form-control" id="vendorcountry" name="country" style="color: #495057">
                                <option value="">Pilih Negara</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendoremail">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" id="vendoremail" class="text-field" placeholder="reza@gmail.com" name="email">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="vendorpassword">Kata Sandi
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="vendorpassword" class="text-field" placeholder="Kata Sandi" name="password">
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="button button-primary w-100">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection