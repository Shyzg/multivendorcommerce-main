@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Perbarui Detail Admin</h4>
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
                        <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Email Admin</label>
                                <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tipe Admin</label>
                                <input class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="admin_name">Nama Admin</label>
                                <input type="text" class="form-control" id="admin_name" placeholder="Masukkan Nama Admin" name="admin_name" value="{{ Auth::guard('admin')->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="admin_mobile">Nomor Handphone Admin</label>
                                <input type="text" class="form-control" id="admin_mobile" placeholder="Masukkan Nomor Handphone Admin" name="admin_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="13" minlength="10">
                            </div>
                            <div class="form-group">
                                <label for="admin_image">Foto Profil</label>
                                <input type="file" class="form-control" id="admin_image" name="admin_image">
                                @if (!empty(Auth::guard('admin')->user()->image))
                                <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
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