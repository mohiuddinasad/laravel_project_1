@extends('backend.layout')
@section('backend_content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="m-0">Category List</h4>
                <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary">Go Back</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-responsive text-center">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Meta Title</th>
                        <th>Meta keywords</th>
                        <th>Meta Description</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($cetagories as $key => $cetagory )
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $cetagory->title }}</td>
                            <td><span class="badge bg-{{ $cetagory->parent ? 'success' : 'danger'}}">{{ $cetagory->parent ? $cetagory->parent->title : 'Not found'}}</span></td>
                            <td>{{ $cetagory->meta_title }}</td>
                            <td>{{ $cetagory->keywords }}</td>
                            <td>{{ $cetagory->description }} </td>
                            <td>
                                <a href="{{ route('dashboard.category.category.edit', $cetagory->slug) }}" class="btn btn-outline-primary">Edit</a>
                                <a href="{{ route('dashboard.category.category.delete', $cetagory->slug) }}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td  colspan="7">
                                <div class="alert alert-danger">No Category found</div>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
