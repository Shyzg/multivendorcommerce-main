@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Produk</h4>
                        <a href="{{ url('admin/add-edit-product') }}" style="max-width: 200px; float: right; display: inline-block" class="btn btn-block btn-primary">Tambahkan Produk</a>
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="products" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Foto Produk</th>
                                        <th>Kategori</th>
                                        <th>Section</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product['product_name'] }}</td>
                                        <td>
                                            @if (!empty($product['product_image']))
                                            <img style="width:120px; height:100px" src="{{ asset('front/images/product_images/small/' . $product['product_image']) }}">
                                            @else
                                            <img style="width:120px; height:100px" src="{{ asset('front/images/product_images/small/no-image.png') }}">
                                            @endif
                                        </td>
                                        <td>{{ $product['category']['category_name'] ?? null }}</td>
                                        <td>{{ $product['section']['name']  ?? null }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ url('admin/add-edit-product/' . $product['id']) }}" class="btn btn-outline-primary mb-2">Perbarui Produk</a>
                                                <a href="{{ url('admin/add-edit-attributes/' . $product['id']) }}" class="btn btn-outline-primary mb-2">Tambah Atribut</a>
                                                <a href="{{ url('admin/add-images/' . $product['id']) }}" class="btn btn-outline-primary mb-2">Tambah Gambar</a>
                                                <a href="JavaScript:void(0)" class="btn btn-outline-danger confirmDelete" module="product" moduleid="{{ $product['id'] }}">
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