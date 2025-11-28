@extends('backend.layout')
@section('backend_content')
    <div class="container">
        <div class="card mt-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="m-0">Category List</h4>
                <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary">Go Back</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-responsive">
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
                            <td>{{ $cetagory->parent_id }}</td>
                            <td>{{ $cetagory->meta_title }}</td>
                            <td>{{ $cetagory->keywords }}</td>
                            <td>{{ $cetagory->description }}</td>
                            <td>
                                <a href="" class="btn btn-outline-primary">Edit</a>
                                <a href="" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection