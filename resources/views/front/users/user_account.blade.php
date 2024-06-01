@extends('front.layout.layout')

@section('content')
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>My Account</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ url('/'); }}">Home</a>
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
                    <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Ubah Data Diri</h2>
                    <p id="account-error"></p>
                    <p id="account-success"></p>
                    <form id="accountForm" action="javascript:;" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="user-email">Surel
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->email }}" style="background-color: #e9e9e9" readonly disabled>
                            <p id="account-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-name">Nama Lengkap
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" type="text" id="user-name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-address">Alamat
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" type="text" id="user-address" name="address" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-city">Kota
                                <span class="astk">*</span>
                            </label>
                            <select class="text-field" id="user-city" name="city" style="color: #495057">
                                <option value="">Pilih Kota</option>
                                @foreach ($cities as $city)
                                <option value="{{ $city['name'] }}" @if ($city['name']==Auth::user()->city) selected @endif>{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-state">Provinsi
                                <span class="astk">*</span>
                            </label>
                            <select class="text-field" id="user-state" name="state" style="color: #495057">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($province as $state)
                                <option value="{{ $state['name'] }}" @if ($state['name']==Auth::user()->state) selected @endif>{{ $state['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-country">Negara
                                <span class="astk">*</span>
                            </label>
                            <select class="text-field" id="user-country" name="country" style="color: #495057">
                                <option value="">Pilih Negara</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country['country_name'] }}" @if ($country['country_name']==Auth::user()->country) selected @endif>
                                    {{ $country['country_name'] }}
                                </option>
                                @endforeach
                            </select>
                            <p id="account-country"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-mobile">Nomor Handphone
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" type="text" id="user-mobile" name="mobile" value="{{ Auth::user()->mobile }}">
                            <p id="account-mobile"></p>
                        </div>
                        <div class="m-b-45">
                            <button class="button button-outline-secondary w-100">Perbarui Data Diri</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Ubah Kata Sandi</h2>
                    <p id="password-success"></p>
                    <p id="password-error"></p>
                    <form id="passwordForm" action="javascript:;" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="current-password">Kata Sandi Saat Ini
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="current-password" class="text-field" placeholder="Kata Sandi Saat Ini" name="current_password">
                            <p id="password-current_password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="usermobile">Kata Sandi Baru
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="new-password" class="text-field" placeholder="Kata Sandi Baru" name="new_password">
                            <p id="password-new_password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="useremail">Konfirmasi Kata Sandi
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="confirm-password" class="text-field" placeholder="Konfirmasi Kata Sandi" name="confirm_password">
                            <p id="password-confirm_password"></p>
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="button button-primary w-100">Perbarui Kata Sandi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection