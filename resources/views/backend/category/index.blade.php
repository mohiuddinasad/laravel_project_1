@extends('backend.layout')
@push('backend_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2 {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        height: 57px;
        border: 1px solid #d5d5d5;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 15px;
        right: 2px;
        width: 30px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #c3c3c3;
        line-height: 28px;
    }
</style>
@endpush
@section('backend_content')
    <div class="container">
        <div class="card mt-3 p-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="m-0">
                    Category
                </h3>
                <a href="{{ route('dashboard.category.category.view') }}" class="btn btn-primary"
                    style="display:flex; align-items: center; justify-content: center; line-height: 0;"><span
                        class="me-2"><iconify-icon icon="lsicon:view-outline" width="18" height="18"></iconify-icon></span>
                    View List</a>
            </div>

            <div class="card-body">
                <form action="{{ route('dashboard.category.category.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="title" placeholder="title" class="form-control p-3">
                        </div>
                        <div class="col-lg-6">
                            <select class="js-example-basic-single" name="state">
                                <option value="" selected disabled>---select category---</option>
                                @foreach ($cetagories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <input type="text" name="meta_title" placeholder="meta title" class="form-control p-3">
                        </div>
                        <div class="col-lg-6 mt-4">
                            <input type="text" name="keywords" placeholder="meta keywords" class="form-control p-3">
                        </div>

                        <div class="col-lg-12 mt-4">
                            <textarea name="description" id="" class="form-control p-3"
                                placeholder="meta descriptions..."></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('backend_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
