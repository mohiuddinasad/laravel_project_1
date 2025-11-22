@extends('backend.layout')
@section('backend_content')
    <div class="container">
        <div class="card p-3 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 pb-0">assign permission</p>
                <a href="" class="btn btn-primary btn-sm">Create new Role</a>
            </div>

            <div class="card-body">
                <form action="{{ route('dashboard.rolePermission.permissions.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="role_name" value="{{ $role->id }}">
                    <table class="table table-responsive table-striped table-bordered text-center">
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
                            <th>Action</th>
                        </tr>
                        
                           @forelse ($permissions as $key => $permission)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                </td>
                           </tr>
                           @empty
                               
                           @endforelse
                    </table>
                    <button class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection