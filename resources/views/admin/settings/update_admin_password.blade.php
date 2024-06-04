@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ubah Kata Sandi Admin</h4>
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
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
                        <form class="forms-sample" action="{{ url('admin/update-admin-password') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Kata Sandi Saat Ini</label>
                                <input type="password" class="form-control" id="current_password" placeholder="Masukkan Kata Sandi Saat Ini" name="current_password" required>
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Kata Sandi Baru</label>
                                <input type="password" class="form-control" id="new_password" placeholder="Masukkan Kata Sandi Baru" name="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Kata Sandi</label>
                                <input type="password" class="form-control" id="confirm_password" placeholder="Konfirmasi Kata Sandi" name="confirm_password" required>
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