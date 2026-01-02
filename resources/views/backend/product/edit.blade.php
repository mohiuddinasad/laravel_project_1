@extends('backend.layout')
@push('backend_css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

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
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Product</h4>
                <a href="{{ route('dashboard.product.show') }}" class="btn btn-primary">Show All</a>
            </div>

            <div class="card-body">
                <form action="{{ route('dashboard.product.update', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="product_title">product title : </label>
                            <input value="{{ $product->title }}" name="title" type="text" placeholder="product title"
                                class="P-3 mb-3 form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="product_title">Select Category : </label>
                            <select class="js-example-basic-single" name="category_id">
                                {{-- <option value="" selected disabled>---select category---</option> --}}
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="product_title">Product Price : </label>
                            <input value="{{ $product->price }}" placeholder="add price" type="number"
                                class="form-control p-2" name="price">
                        </div>
                        <div class="col-lg-6">
                            <label for="product_title">Product Discount Price : </label>
                            <input value="{{ $product->discount_price }}" placeholder="add price" type="number"
                                class="form-control p-2" name="discount_price">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="product_title">Select Stock : </label>
                            <select name="stock" id="" class="form-control  mb-3">
                                <option value="1" {{ $product->stock == 1 ? 'selected' : '' }}>in stock</option>
                                <option value="0" {{ $product->stock == 0 ? 'selected' : '' }}>out stock</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="product_title">Select Status : </label>
                            <select name="status" id="" class="form-control  mb-3">
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg-6 ">
                            <label for="product_details">Product Details : </label>
                            <textarea placeholder="product details...." name="descriptions" id=""
                                class="form-control">{{ $product->descriptions }}</textarea>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="row">
                                @foreach ($product->productImage as $image)
                                    <div class="col-2">
                                        <div class="mb-2">
                                            <img width="50" src="{{ asset('storage/product_images/' . $image->image_name) }}"
                                                alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <label for="product_details">Uploaded Images : </label>
                            <input name="images[]" multiple type="file" class="images form-control p-2">

                        </div>

                        <button type="submit" class="btn btn-primary mt-2 p-2">Upload</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
@push('backend_js')
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script>
        $('.images').filepond({
            allowMultiple: true,
            storeAsFile: true
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
