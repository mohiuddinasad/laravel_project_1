@extends('backend.layout')

@section('backend_content')

    <div class="container">
        <div class="card mt-3 p-2">
            <div class="card-header">
                User List
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($userInfo as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><img src="{{ asset('storage/profileImages/' . $user->profile_image) }}" alt="User Image"
                                    width="50"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('dashboard.rolePermission.user.edit', $user->id) }}"
                                    class="btn btn-primary btn-sm d-inline-flex align-items-center justify-content-center">
                                     <iconify-icon icon="akar-icons:edit" width="24" height="24"></iconify-icon>
                                </a>
                                <a href="{{ route('dashboard.rolePermission.user.delete', $user->id) }}"
                                    class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="proicons:delete" width="24" height="24"></iconify-icon>
                                </a>
                                <a href="{{ route('dashboard.rolePermission.role.list', $user->id) }}"
                                    class="btn btn-primary btn-sm d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="eos-icons:admin-outlined" width="24" height="24"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
