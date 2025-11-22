@extends('backend.layout')
@section('backend_content')
    <div class="container">
        <div class="card mt-3 p-2">
            <div class="card-header">
                Role Assign to {{ $user->name }}
            </div>

            <div class="card-body">

                <form action="{{ route('dashboard.rolePermission.role.list.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <table class="table table-bordered table-striped text-center">
                        <tr>
                            <th>Id</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td> <label for="role_{{ $role->id }}">{{ $role->name }}</label></td>
                                <td>
                                    <input {{ $user->hasRole($role->name) ? 'checked' : '' }} name="roles[]" type="checkbox" id="role_{{ $role->id }}" value="{{ $role->name }}">
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
