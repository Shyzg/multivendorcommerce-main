@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h4 class="card-title">Attributes</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Attributes</h4>
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
                        <form class="forms-sample" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product Name:</label>
                                &nbsp; {{ $product['product_name'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price:</label>
                                &nbsp; {{ $product['product_price'] }}
                            </div>
                            <div class="form-group">
                                {{-- Show the product image, if any (if exits) --}}
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
                                        <input type="text" name="stock[]" placeholder="Stock" style="width:100px" required>
                                        <a href="javascript:void(0);" class="add_button" title="Add Attributes">Add</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                        <h4 class="card-title">Product Attributes</h4>
                        <form method="post" action="{{ url('admin/edit-attributes/' . $product['id']) }}">
                            @csrf
                            <table id="products" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>SKU</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product['attributes'] as $attribute)
                                    <input style="display: none" type="text" name="attributeId[]" value="{{ $attribute['id'] }}"> {{-- A hidden input field --}}
                                    <tr>
                                        <td>{{ $attribute['id'] }}</td>
                                        <td>{{ $attribute['sku'] }}</td>
                                        <td>
                                            <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" required style="width: 60px">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Update Attributes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection