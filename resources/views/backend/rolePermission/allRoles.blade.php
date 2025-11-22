@extends('backend.layout')
@section('backend_content')
    <div class="container">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 pb-0">Roles</p>
                <a href="" class="btn btn-primary btn-sm">Create new Role</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Assign Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('dashboard.rolePermission.permissions', $role->id) }}">
                                        <iconify-icon icon="tdesign:key" width="24" height="24"></iconify-icon>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection