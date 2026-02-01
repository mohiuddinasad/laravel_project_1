@forelse ($products as $product)
    <div class="js-pagination-item product filter_body col-lg-3 p-0">
        <div class="filter fruit">
            <span class="sale">Sale 50%</span>
            <a href="{{ route('frontend.product.details', $product->slug) }}">
                @if ($product->productImage->first())
                    <img class="img-fluid"
                        src="{{ asset('storage/product_images/' . $product->productImage->first()->image_name) }}"
                        alt="{{ $product->title }}">
                @else
                    <img class="img-fluid" src="{{ asset('images/no-image.png') }}" alt="{{ $product->title }}">
                @endif
            </a>
            <div class="details">
                <div class="row justify-content-between align-items-center">
                    <div class="col-8">
                        <h4 class="m-0">{{ $product->title }}</h4>
                        <b>${{ number_format($product->price, 2) }}</b>
                        @if ($product->discount_price)
                            <del>${{ number_format($product->discount_price, 2) }}</del>
                        @endif
                        <div class="rate">
                            <ul>
                                @for ($i = 0; $i < 5; $i++)
                                    <li>
                                        <iconify-icon icon="material-symbols-light:star" width="18"
                                            height="18"></iconify-icon>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="col-4 bag_icon">
                        <a class="bag" href="{{ route('frontend.add.to.cart', $product->id) }}">
                            <iconify-icon icon="teenyicons:bag-outline" width="24" height="24"></iconify-icon>
                        </a>
                    </div>
                </div>
            </div>
            <span class="eye">
                <iconify-icon icon="bi:eye" width="20" height="20"></iconify-icon>
            </span>
            <span class="heart add-to-wishlist" data-product-id="{{ $product->id }}">
                <iconify-icon icon="bi:heart" width="20" height="20"></iconify-icon>
            </span>
        </div>
    </div>
@empty
    <p class="text-center text-danger">No products found matching your filters.</p>
@endforelse
