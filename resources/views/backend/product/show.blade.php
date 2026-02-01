@extends('backend.layout')
@section('backend_content')
    <div class="container">
        <div class="card mt-3"> 
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Product list</h4>
                <a href="{{ route('dashboard.product.index') }}" class="btn btn-primary"><iconify-icon
                        icon="icon-park-solid:back" width="24" height="24"></iconify-icon></a>
            </div>
            <div class="card-body " style="overflow-x: auto">
                <table class="table table-border table-hover table-striped" style="width: 100%">
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Category</td>
                        <td>Images</td>
                        <td>Price</td>
                        <td>Discount Price</td>
                        <td>Is Stock</td>
                        <td>Status</td>
                        <td>Descriptions </td>
                        <td>Actions</td>
                    </tr>

                    @forelse ($products as $key => $product)
                        <tr>
                            <td>{{ ++ $key }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->category->title }}</td>
                            <td style="min-width: 300px">
                                <div class="row">
                                    @foreach ($product->productImage as $image)
                                        <div class="col-4">
                                            <div
                                                style=" display: flex; align-items: center; line-height: 0; justify-content: center; gap: 5px; position: relative;">
                                                <img style="height: 50px; object-fit: cover;" class="img-fluid shadow"
                                                    src="{{ asset('storage/product_images/' . $image->image_name) }}" alt="">
                                                <a href="{{ route('dashboard.product.image.delete', $image->id) }}"
                                                    style=" position: absolute; top: -10px; right:-3px; border-radius: 50%; color: #fff;"
                                                    class="bg-primary p-1">
                                                    <iconify-icon icon="proicons:delete" width="20" height="20"></iconify-icon>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>
                                @if ($product->stock == 1)
                                    <span class="badge bg-success">In Stock</span>
                                @else
                                    <span class="badge bg-danger">Out Stock</span>
                                @endif
                            </td>
                            <td>
                                @if ($product->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $product->descriptions }}</td>
                            <td style="min-width: 200px">
                                <a href="{{ route('dashboard.product.edit', $product->slug) }}"
                                    class="btn btn-sm btn-primary"><iconify-icon icon="lucide:edit" width="24"
                                        height="24"></iconify-icon></a>
                                <a href="{{ route('dashboard.product.delete.product', $product->slug) }}"
                                    class="btn btn-sm btn-danger"><iconify-icon icon="lucide:trash-2" width="24"
                                        height="24"></iconify-icon></a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="text-center alert alert-danger">No Products found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
