@extends('front.layout.layout')

@section('content')
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
                    <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Update Contact Details</h2>
                    <p id="account-error"></p>
                    <p id="account-success"></p>
                    <form id="accountForm" action="javascript:;" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="user-email">Email
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" style="background-color: #e9e9e9" readonly disabled>
                            <p id="account-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-name">Name
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" type="text" id="user-name" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-address">Address
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" type="text" id="user-address" name="address" value="{{ \Illuminate\Support\Facades\Auth::user()->address }}">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-city">City
                                <span class="astk">*</span>
                            </label>
                            <select class="text-field" id="user-city" name="city" style="color: #495057">
                                <option value="">Select City</option>
                                @foreach ($cities as $city) {{-- $countries was passed from UserController to view using compact() method --}}
                                <option value="{{ $city['name'] }}" @if ($city['name']==\Illuminate\Support\Facades\Auth::user()->city) selected @endif>{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-state">State / Province
                                <span class="astk">*</span>
                            </label>
                            <select class="text-field" id="user-state" name="state" style="color: #495057">
                                <option value="">Select State</option>
                                @foreach ($province as $state) {{-- $countries was passed from UserController to view using compact() method --}}
                                <option value="{{ $state['name'] }}" @if ($state['name']==\Illuminate\Support\Facades\Auth::user()->state) selected @endif>{{ $state['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-country">Country
                                <span class="astk">*</span>
                            </label>
                            <select class="text-field" id="user-country" name="country" style="color: #495057">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country['country_name'] }}" @if ($country['country_name']==\Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['country_name'] }}</option>
                                @endforeach
                            </select>
                            <p id="account-country"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-mobile">Mobile
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" type="text" id="user-mobile" name="mobile" value="{{ \Illuminate\Support\Facades\Auth::user()->mobile }}">
                            <p id="account-mobile"></p>
                        </div>
                        <div class="m-b-45">
                            <button class="button button-outline-secondary w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20" style="font-size: 18px">Update Password</h2>
                    <p id="password-success"></p>
                    <p id="password-error"></p>
                    <form id="passwordForm" action="javascript:;" method="post">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="current-password">Current Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="current-password" class="text-field" placeholder="Current Password" name="current_password">
                            <p id="password-current_password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="usermobile">New Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="new-password" class="text-field" placeholder="New Password" name="new_password">
                            <p id="password-new_password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="useremail">Confirm Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="confirm-password" class="text-field" placeholder="Confirm Password" name="confirm_password">
                            <p id="password-confirm_password"></p>
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="button button-primary w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection