@extends('admin.layout.layout')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Admin ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin['id'] }}</td>
                                        <td>{{ $admin['name'] }}</td>
                                        <td>{{ $admin['type'] }}</td>
                                        <td>{{ $admin['mobile'] }}</td>
                                        <td>{{ $admin['email'] }}</td>
                                        <td>
                                            @if ($admin['image'] != '')
                                            <img src="{{ asset('admin/images/photos/' . $admin['image']) }}">
                                            @else
                                            <img src="{{ asset('admin/images/photos/no-image.gif') }}">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($admin['type'] == 'vendor')
                                            <a href="{{ url('admin/view-vendor-details/' . $admin['id']) }}">
                                                <i style="font-size: 25px" class="mdi mdi-file-document"></i>
                                            </a>
                                            @endif
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
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
@endsection