@extends('backend.layout')
@section('backend_content')
<div class="container">
    <div class="card p-3 mt-2">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="m-0">Create Role</h4>
            <a href="" class="btn btn-primary">Role List</a>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.rolePermission.create.role.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="role_name" class="form-label">Role Name</label>
                    <input type="role_name" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name">
                    @error('role_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Create Role</button>
            </form>
        </div>
    </div>
</div>
@endsection
