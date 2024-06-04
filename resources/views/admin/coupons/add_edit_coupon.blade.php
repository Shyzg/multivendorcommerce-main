@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
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
                        <form class="forms-sample" @if (empty($coupon->id)) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/' . $coupon->id) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                            @if (empty($coupon->coupon_code))
                            <div class="form-group">
                                <label for="coupon_option">Opsi Kupon</label><br>
                                <span><input type="radio" id="AutomaticCoupon" name="coupon_option" value="Automatic" checked>Otomatis</span>
                                <span><input type="radio" id="ManualCoupon" name="coupon_option" value="Manual">Manual</span>
                            </div>
                            <div class="form-group" style="display: none" id="couponField">
                                <label for="coupon_code">Kode Kupon</label>
                                <input type="text" class="form-control" placeholder="Masukkan Kode Kupon" name="coupon_code">
                            </div>
                            @else
                            <input type="hidden" name="coupon_option" value="{{ $coupon->coupon_option }}">
                            <input type="hidden" name="coupon_code" value="{{ $coupon->coupon_code }}">
                            <div class="form-group">
                                <label for="coupon_code">Kode Kupon</label>
                                <span style="color: green; font-weight: bold">{{ $coupon->coupon_code }}</span>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="coupon_type">Tipe Kupon Berdasarkan</label><br>
                                <span><input type="radio" name="coupon_type" value="Dapat Digunakan Berulang" @if (isset($coupon->coupon_type) && $coupon->coupon_type=='Dapat Digunakan Berulang' ) checked @endif>Dapat Digunakan Berulang</span>
                                <span><input type="radio" name="coupon_type" value="Sekali Pakai" @if (isset($coupon->coupon_type) && $coupon->coupon_type=='Sekali Pakai' ) checked @endif>Sekali Pakai</span>
                            </div>
                            <div class="form-group">
                                <label for="amount_type">Tipe Jumlah Berdasarkan</label><br>
                                <span><input type="radio" name="amount_type" value="Persentase" @if (isset($coupon->amount_type) && $coupon->amount_type=='Percentage' ) checked @endif>Persentase</span>
                                <span><input type="radio" name="amount_type" value="Tetap" @if (isset($coupon->amount_type) && $coupon->amount_type=='Tetap' ) checked @endif>Jumlah Tetap</span>
                            </div>
                            <div class="form-group">
                                <label for="amount">Jumlah</label>
                                <input type="text" class="form-control" id="amount" placeholder="Enter Coupon Amount" name="amount" @if (isset($coupon->amount)) value="{{ $coupon->amount }}" @else value="{{ old('amount') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="categories">Pilih category</label>
                                <select name="categories[]" class="form-control text-dark" multiple>
                                    @foreach ($categories as $section)
                                    <optgroup label="{{ $section->name }}">
                                        @foreach ($section->categories as $category)
                                        <option value="{{ $category->id }}" @if (in_array($category->id, $selCats)) selected @endif>
                                            &nbsp;&nbsp;&nbsp;--&nbsp;{{ $category->category_name }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="users">Pilih customer berdasarkan email</label>
                                <select name="users[]" class="form-control text-dark" multiple>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->email }}" @if (in_array($user->email, $selUsers)) selected @endif>{{ $user->email }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expiry_date">Tanggal kupon berakhir</label>
                                <input type="date" class="form-control" id="expiry_date" placeholder="Enter Expiry Date" name="expiry_date" @if (isset($coupon->expiry_date)) value="{{ $coupon->expiry_date }}" @else value="{{ old('expiry_date') }}" @endif>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection