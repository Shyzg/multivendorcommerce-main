@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Kategori</h4>
                        <a href="{{ url('admin/add-edit-category') }}" style="max-width: 200px; float: right; display: inline-block" class="btn btn-block btn-primary">Tambahkan Kategori</a>
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="categories" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Parent Section</th>
                                        <th>URL</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category['category_name'] }}</td>
                                        <td>{{ $category['section']['name'] }}</td>
                                        <td>{{ $category['url'] }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ url('admin/add-edit-category/' . $category['id']) }}" class="btn btn-outline-primary mb-2">Perbarui Kategori</a>
                                                <a href="JavaScript:void(0)" class="btn btn-outline-danger confirmDelete" module="product" moduleid="{{ $category['id'] }}">
                                                    Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection