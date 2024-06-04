@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Pembeli</h2>
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
                    <p id="login-error"></p>
                    <form id="loginForm" action="javascript:;" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="user-email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" name="email" id="users-email" class="text-field" placeholder="Email" name="email">
                            <p id="login-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-password">Kata Sandi
                                <span class="astk">*</span>
                            </label>
                            <input type="password" name="password" id="users-password" class="text-field" placeholder="Password" name="password">
                            <p id="login-password"></p>
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
                    <p id="register-success"></p>
                    <form id="registerForm" action="{{ url('/user/register') }}" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="username">Nama
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="user-name" class="text-field" placeholder="Marvin Hidayat" name="name">
                            <p id="register-name"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="usermobile">Nomor Handphone
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="user-mobile" class="text-field" placeholder="081234567890" name="mobile">
                            <p id="register-mobile"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="address">Alamat
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="address" class="text-field" placeholder="Babatan Mukti A-15" name="address">
                            <p id="register-address"></p>
                        </div>
                        <div class="form-group">
                            <label for="city">Kota</label>
                            <select class="form-control" id="city" name="city" style="color: #495057">
                                <option value="">Pilih Kota</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">Provinsi</label>
                            <select class="form-control" id="state" name="state" style="color: #495057">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $state)
                                <option value="{{ $state['name'] }}">{{ $state['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Negara</label>
                            <select class="form-control" id="country" name="country" style="color: #495057">
                                <option value="">Pilih Negara</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="useremail">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" id="user-email" class="text-field" placeholder="marvin@gmail.com" name="email">
                            <p id="register-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="userpassword">Kata Sandi
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="user-password" class="text-field" placeholder="Kata Sandi" name="password">
                            <p id="register-password"></p>
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