@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Atribut</h4>
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
                        <form class="forms-sample mb-2" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}" method="post">
                            @csrf
                            <div class="form-group">{{ $product['product_name'] }}</div>
                            <div class="form-group">
                                @if (!empty($product['product_image']))
                                <img style="width: 120px" src="{{ url('front/images/product_images/small/' . $product['product_image']) }}">
                                @else
                                <img style="width: 120px" src="{{ url('front/images/product_images/small/no-image.png') }}">
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="sku[]" placeholder="SKU" style="width:100px" required>
                                        <input type="text" name="stock[]" placeholder="Stok" style="width:100px" required>
                                        <a href="javascript:void(0);" class="add_button" title="Add Attributes">Add</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                        <form method="post" action="{{ url('admin/edit-attributes/' . $product['id']) }}">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product['attributes'] as $attribute)
                                    <input style="display: none" type="text" name="attributeId[]" value="{{ $attribute['id'] }}">
                                    <tr>
                                        <td>{{ $attribute['sku'] }}</td>
                                        <td>
                                            <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required style="width: 60px">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Perbarui Atribut</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection