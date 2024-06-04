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
                        <form class="forms-sample" @if (empty($product->id)) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product->id) }}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category_id">Pilih Category</label>
                                <select name="category_id" id="category_id" class="form-control text-dark">
                                    <option value="">Category</option>
                                    @foreach ($categories as $section)
                                    <optgroup label="{{ $section->name }}">
                                        @foreach ($section->categories as $category)
                                        <option value="{{ $category->id }}" @if (!empty($product->category_id==$category->id)) selected @endif>
                                            {{ $category->category_name }}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Masukkan Nama Produk" name="product_name" @if (!empty($product->product_name)) value="{{ $product->product_name }}" @else value="{{ old('product_name') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Harga Produk</label>
                                <input type="text" class="form-control" id="product_price" placeholder="Masukkan Harga Produk" name="product_price" @if (!empty($product->product_price)) value="{{ $product->product_price }}" @else value="{{ old('product_price') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_discount">Diskon Produk</label>
                                <input type="text" class="form-control" id="product_discount" placeholder="Masukkan Diskon Produk Dalam Persentase" name="product_discount" @if (!empty($product->product_discount)) value="{{ $product->product_discount }}" @else value="{{ old('product_discount') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_weight">Berat Produk</label>
                                <input type="text" class="form-control" id="product_weight" placeholder="Masukkan Berat Produk Dalam Persentase" name="product_weight" @if (!empty($product->product_weight)) value="{{ $product->product_weight }}" @else value="{{ old('product_weight') }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_image">Foto Produk</label>
                                <input type="file" class="form-control" id="product_image" name="product_image">
                                @if (!empty($product->product_image))
                                <a href="JavaScript:void(0)" class="confirmDelete" module="product-image" moduleid="{{ $product->id }}">Hapus Foto Produk</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Produk</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="is_bestseller">Best Seller</label>
                                <input type="checkbox" name="is_bestseller" id="is_bestseller" value="Yes" @if (!empty($product->is_bestseller) && $product->is_bestseller=='Yes' ) checked @endif>
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