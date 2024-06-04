@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Kupon</h4>
                        <a href="{{ url('admin/add-edit-coupon') }}" style="max-width: 150px; float: right; display: inline-block" class="btn btn-block btn-primary">Tambah Kupon</a>
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="coupons" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode Kupon</th>
                                        <th>Tipe Kupon</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Berakhir Kupon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->coupon_type }}</td>
                                        <td>
                                            {{ $coupon->amount }}
                                            @if ($coupon->amount_type == 'Persentase')
                                            %
                                            @else
                                            IDR
                                            @endif
                                        </td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ url('admin/add-edit-coupon/' . $coupon->id) }}" class="btn btn-outline-primary mb-2">Perbarui Kupon</a>
                                                <a href="JavaScript:void(0)" class="btn btn-outline-danger confirmDelete" module="coupon" moduleid="{{ $coupon->id }}">
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