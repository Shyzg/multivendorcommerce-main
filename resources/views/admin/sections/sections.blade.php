@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sections</h4>
                        <a href="{{ url('admin/add-edit-section') }}" style="max-width: 200px; float: right; display: inline-block" class="btn btn-block btn-primary">Tambahkan Section</a>
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="sections" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Section</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section['name'] }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ url('admin/add-edit-section/' . $section['id']) }}" class="btn btn-outline-primary mb-2">Perbarui Section</a>
                                                <a href="JavaScript:void(0)" class="btn btn-outline-danger confirmDelete" module="product" moduleid="{{ $section['id'] }}">
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