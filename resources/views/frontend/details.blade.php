@php
    $cart = session('cart', []);
    $qty = array_sum(array_column($cart, 'qty'));
@endphp
@php
    $totalAmount = 0;
@endphp
@foreach ($cart as $id => $data)
    @php
        $totalAmount += $data['price'] * $data['qty'];
    @endphp
@endforeach

@extends('frontend.layout')
@section('frontend_content')
    <!-- ========== Start breadcrumbs_bg ========== -->
    <section id="breadcrumbs_bg" style="background-image: url(./assets/images/details_bg.png);">
        <div class="container">
            <div class="title">
                <p>

                    <span class="icon"><iconify-icon icon="bitcoin-icons:home-outline" width="24"
                            height="24"></iconify-icon></span>
                    >
                    <span>Category</span> > <span>{{ $product->category->title }}</span> >
                    <span>{{ $product->title }}</span>

                </p>
            </div>
        </div>
    </section>
    <!-- ========== End breadcrumbs_bg ========== -->
    <!-- ========== Start product_details ========== -->
    <section id="product_details" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="row align-items-center">
                        <div class="col-lg-3 order-2 order-lg-1 slider-nav">

                            @foreach ($product->productImage as $image)
                                <div><img class="img-fluid"
                                        src="{{ asset('storage/product_images/' . $image->image_name) }}" alt="">
                                </div>
                            @endforeach

                        </div>
                        <div class="col-lg-9 order-1 order-lg-2 slider-for">

                            @foreach ($product->productImage as $image)
                                <div><img class="img-fluid example" style="width: 100%; height: 100%;"
                                        src="{{ asset('storage/product_images/' . $image->image_name) }}" alt="">
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="col-lg-7 product">
                    <div class="product_name">
                        <h4>{{ $product->title }}</h4>
                        <span>In Stock</span>
                    </div>
                    <div class="rate">
                        <ul>
                            <li><span><iconify-icon icon="twemoji:star" width="14" height="14"></iconify-icon></span>
                            </li>
                            <li><span><iconify-icon icon="twemoji:star" width="14" height="14"></iconify-icon></span>
                            </li>
                            <li><span><iconify-icon icon="twemoji:star" width="14" height="14"></iconify-icon></span>
                            </li>
                            <li><span><iconify-icon icon="twemoji:star" width="14" height="14"></iconify-icon></span>
                            </li>
                            <li><span><iconify-icon icon="twemoji:star" width="14" height="14"></iconify-icon></span>
                            </li>
                            <span class="review"> 4 Review</span>
                        </ul>
                        <div class="SKU">
                            <b>SKU:</b>
                            <span>2,51,594</span>
                        </div>
                    </div>
                    <div class="price">
                        <b class="price">${{ $product->price }}</b>
                        <del>${{ $product->discount_price }}</del>
                        <span>64% Off</span>
                    </div>
                    <div class="row brand_row justify-content-between align-items-center">
                        <div class="col-lg-2">
                            <div class="brand d-flex align-items-center">
                                <span>Brand:</span>
                                <img src="{{ asset('frontend/assets/images/porduct_brand.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="share">
                                <p>
                                    Share item:
                                </p>
                                <div class="icons">
                                    <span><iconify-icon icon="ri:facebook-fill" width="24"
                                            height="24"></iconify-icon></span>
                                    <span><iconify-icon icon="mdi:twitter" width="24"
                                            height="24"></iconify-icon></span>
                                    <span><iconify-icon icon="jam:pinterest" width="24"
                                            height="24"></iconify-icon></span>
                                    <span><iconify-icon icon="uil:instagram" width="24"
                                            height="24"></iconify-icon></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contain">
                        <p>{{ $product->descriptions }}
                        </p>
                    </div>
                    <div class="row cart_row align-items-center">
                        <div class="col-lg-3 d-flex justify-content-start px-lg-3">
                            <div class="qty-control" style="position: relative;">
                                <button type="button" class="qty-decrease decrease" data-id="{{ $product->id }}">-</button>
                                <div id="qty-{{ $product->id }}" class="qty-display">{{ $data['qty'] ?? 1 }}</div>
                                <!-- Loading spinner -->
                                <div id="loading-spinner-{{ $product->id }}" class="" role="status" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10;">

                                </div>
                                <button type="button" class="qty-increase increase" data-id="{{ $product->id }}">+</button>
                            </div>
                        </div>
                        <div class="col-7 px-0 cart">
                            <a href="{{ route('frontend.add.to.cart', $product->id) }}" class="cart_btn">Add to Cart
                                <span><iconify-icon icon="ph:handbag-bold" width="24"
                                        height="24"></iconify-icon></span></a>
                        </div>
                        <div class="col-2 wishlist add-to-wishlist">
                            <span class="heart"><iconify-icon icon="si:heart-line" width="24"
                                    height="24"></iconify-icon></span>
                        </div>
                    </div>
                    <div class="text">
                        <p><b>Category:</b>{{ $product->category->title }}</p>
                        <p><b>Tag:</b>Vegetables Healthy <a href="">Chinese</a> Cabbage Green Cabbage</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End product_details ========== -->
    <!-- ========== Start description ========== -->
    <section id="description">
        <div class="container">
            <div class="tabs js-tabs">
                <div class="tabs-nav js-tabs-nav" id="example">
                    <ul class="tabs-nav__list">
                        <li class="tabs-nav__item js-tabs-item active">
                            <a class="tabs-nav__link js-tabs-link" href="#tab-1">Descriptions</a>
                        </li>
                        <li class="tabs-nav__item js-tabs-item">
                            <a class="tabs-nav__link js-tabs-link" href="#tab-2">Information</a>
                        </li>
                        <li class="tabs-nav__item js-tabs-item">
                            <a class="tabs-nav__link js-tabs-link" href="#tab-3">Feedback</a>
                        </li>
                    </ul>
                    <span class="tabs-nav__drag js-tabs-drag"></span>
                </div>
                <div class="tabs-content js-tabs-wrap">
                    <div class="tab js-tabs-content active" id="tab-1">
                        <div class="row justify-content-between" style="width: 100%;">
                            <div class="col-lg-6 contain">
                                <p>Sed commodo aliquam dui ac porta. Fusce ipsum felis, imperdiet at posuere ac, viverra
                                    at mauris. Maecenas tincidunt ligula a sem vestibulum pharetra. Maecenas auctor
                                    tortor lacus, nec laoreet nisi porttitor vel. Etiam tincidunt metus vel dui interdum
                                    sollicitudin. Mauris sem ante, vestibulum nec orci vitae, aliquam mollis lacus. Sed
                                    et condimentum arcu, id molestie tellus. Nulla facilisi. Nam scelerisque vitae justo
                                    a convallis. </p>
                                <p>Nulla mauris tellus, feugiat quis pharetra sed, gravida ac dui. Sed iaculis, metus
                                    faucibus elementum tincidunt, turpis mi viverra velit, pellentesque tristique neque
                                    mi eget nulla. Proin luctus elementum neque et pharetra. </p>
                                <ul>
                                    <li>
                                        <span><iconify-icon icon="tabler:check" width="14"
                                                height="14"></iconify-icon></span>
                                        <p class="m-0">100 g of fresh leaves provides.</p>
                                    </li>
                                    <li>
                                        <span><iconify-icon icon="tabler:check" width="14"
                                                height="14"></iconify-icon></span>
                                        <p class="m-0">Aliquam ac est at augue volutpat elementum.</p>
                                    </li>
                                    <li>
                                        <span><iconify-icon icon="tabler:check" width="14"
                                                height="14"></iconify-icon></span>
                                        <p class="m-0">Quisque nec enim eget sapien molestie.</p>
                                    </li>
                                    <li>
                                        <span><iconify-icon icon="tabler:check" width="14"
                                                height="14"></iconify-icon></span>
                                        <p class="m-0">Proin convallis odio volutpat finibus posuere.</p>
                                    </li>
                                </ul>
                                <p>Cras et diam maximus, accumsan sapien et, sollicitudin velit. Nulla blandit eros non
                                    turpis lobortis iaculis at ut massa. </p>
                            </div>
                            <div class="col-lg-5 vedio ">
                                <a class="venobox" data-gall="gall-video" data-autoplay="true" data-vbtype="video"
                                    data-ratio="4x3" href="https://youtu.be/O8t5xxOYa6w">
                                    <img class="img-fluid" src="./assets/images/thumble-2.png" alt="">
                                </a>
                                <div class="row">
                                    <div class="col-6 discount">
                                        <div class="icon">
                                            <span><iconify-icon icon="fluent:tag-percent-24-regular" width="26"
                                                    height="26"></iconify-icon></span>
                                        </div>
                                        <div class="text">
                                            <h4>64% Discount</h4>
                                            <p>Save your 64% money with us</p>
                                        </div>
                                    </div>
                                    <div class="col-6 discount">
                                        <div class="icon">
                                            <span><iconify-icon icon="garden:leaf-stroke-16" width="26"
                                                    height="26"></iconify-icon></span>
                                        </div>
                                        <div class="text">
                                            <h4>100% Organic</h4>
                                            <p>100% Organic Vegetables</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab js-tabs-content" id="tab-2">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 additional">
                                <div class="row">
                                    <div class="col-4 type">
                                        <h6 class="m-0">Weight:</h6>
                                        <h6 class="m-0">Color:</h6>
                                        <h6 class="m-0">Type:</h6>
                                        <h6 class="m-0">Category:</h6>
                                        <h6 class="m-0">Stock Status:</h6>
                                        <h6 class="m-0">Tags:</h6>
                                    </div>
                                    <div class="col-8 type">
                                        <p class="m-0">03</p>
                                        <p class="m-0">Green</p>
                                        <p class="m-0">Organic</p>
                                        <p class="m-0">Vegetables</p>
                                        <p class="m-0">Available (5,413)</p>
                                        <p class="m-0">Vegetables,
                                            Healthy,
                                            <a href="">Chinese,</a>
                                            Cabbage,
                                            Green Cabbage,
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 vedio ">
                                <a class="venobox" data-gall="gall-video" data-autoplay="true" data-vbtype="video"
                                    data-ratio="4x3" href="https://youtu.be/O8t5xxOYa6w">
                                    <img class="img-fluid" src="./assets/images/thumble-2.png" alt="">
                                </a>
                                <div class="row">
                                    <div class="col-6 discount">
                                        <div class="icon">
                                            <span><iconify-icon icon="fluent:tag-percent-24-regular" width="26"
                                                    height="26"></iconify-icon></span>
                                        </div>
                                        <div class="text">
                                            <h4>64% Discount</h4>
                                            <p>Save your 64% money with us</p>
                                        </div>
                                    </div>
                                    <div class="col-6 discount">
                                        <div class="icon">
                                            <span><iconify-icon icon="garden:leaf-stroke-16" width="26"
                                                    height="26"></iconify-icon></span>
                                        </div>
                                        <div class="text">
                                            <h4>100% Organic</h4>
                                            <p>100% Organic Vegetables</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab js-tabs-content" id="tab-3">
                        <div class="feedback">
                            <div class="row first_row">
                                <div class="col-lg-7 comment">
                                    <div class="row justify-content-between">
                                        <div class="col-6 user_details">
                                            <div class="image">
                                                <img class="img-fluid" src="./assets/images/customer/1.png"
                                                    alt="">
                                            </div>
                                            <div class="rate">
                                                <h4>Kristin Watson</h4>
                                                <ul>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-4 date">
                                            <p class="m-0">2 min ago</p>
                                        </div>
                                    </div>
                                    <p class="text">Duis at ullamcorper nulla, eu dictum eros.</p>
                                </div>
                            </div>
                            <div class="row first_row">
                                <div class="col-lg-7 comment">
                                    <div class="row justify-content-between">
                                        <div class="col-6 user_details">
                                            <div class="image">
                                                <img class="img-fluid" src="./assets/images/customer/2.png"
                                                    alt="">
                                            </div>
                                            <div class="rate">
                                                <h4>Jane Cooper</h4>
                                                <ul>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-4 date">
                                            <p class="m-0">30 Apr, 2021</p>
                                        </div>
                                    </div>
                                    <p class="text">Keep the soil evenly moist for the healthiest growth. If the sun
                                        gets too hot, Chinese cabbage tends to "bolt" or go to seed; in long periods of
                                        heat, some kind of shade may be helpful. Watch out for snails, as they will harm
                                        the plants.</p>
                                </div>
                            </div>
                            <div class="row first_row">
                                <div class="col-lg-7 comment">
                                    <div class="row justify-content-between">
                                        <div class="col-6 user_details">
                                            <div class="image">
                                                <img class="img-fluid" src="./assets/images/customer/3.png"
                                                    alt="">
                                            </div>
                                            <div class="rate">
                                                <h4>Jacob Jones</h4>
                                                <ul>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-4 date">
                                            <p class="m-0">2 min ago</p>
                                        </div>
                                    </div>
                                    <p class="text"> Vivamus eget euismod magna. Nam sed lacinia nibh, et lacinia lacus.
                                    </p>
                                </div>
                            </div>
                            <div class="row first_row">
                                <div class="col-lg-7 comment">
                                    <div class="row justify-content-between">
                                        <div class="col-6 user_details">
                                            <div class="image">
                                                <img class="img-fluid" src="./assets/images/customer/4.png"
                                                    alt="">
                                            </div>
                                            <div class="rate">
                                                <h4>Ralph Edwards</h4>
                                                <ul>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                    <li><span><iconify-icon icon="twemoji:star" width="14"
                                                                height="14"></iconify-icon></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-4 date">
                                            <p class="m-0">2 min ago</p>
                                        </div>
                                    </div>
                                    <p class="text">200+ Canton Pak Choi Bok Choy Chinese Cabbage Seeds Heirloom Non-GMO
                                        Productive Brassica rapa VAR. chinensis, a.k.a. Canton's Choice, Bok Choi, from
                                        USA
                                    </p>
                                </div>
                            </div>
                            <div class="load">
                                <a href="">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End description ========== -->
@endsection
@push('frontend_js')

    <script>
        $(document).on('click', '.increase', function (e) {
            e.preventDefault();

            let productId = $(this).data('id');

            // Show loading spinner and disable buttons
            $('#loading-spinner-' + productId).show();
            $('#qty-' + productId).css('opacity', '0.5');
            $('.increase, .decrease').prop('disabled', true);

            $.ajax({
                url: "{{ url('increase') }}/" + productId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        // Update the quantity display
                        $('#qty-' + productId).text(response.qty);
                        $('#qty-' + productId).css('opacity', '1');
                    }

                    // Hide loading spinner and re-enable buttons
                    $('#loading-spinner-' + productId).hide();
                    $('.increase, .decrease').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating quantity:', error);
                    console.error('Response:', xhr.responseText);
                    alert('Failed to update quantity. Please try again.');

                    // Hide loading spinner and re-enable buttons
                    $('#loading-spinner-' + productId).hide();
                    $('#qty-' + productId).css('opacity', '1');
                    $('.increase, .decrease').prop('disabled', false);
                }
            });
        });

        $(document).on('click', '.decrease', function (e) {
            e.preventDefault();

            let productId = $(this).data('id');
            let currentQty = parseInt($('#qty-' + productId).text());

            // Don't allow decrease below 1
            if (currentQty <= 1) {
                return;
            }

            // Show loading spinner and disable buttons
            $('#loading-spinner-' + productId).show();
            $('#qty-' + productId).css('opacity', '0.5');
            $('.increase, .decrease').prop('disabled', true);

            $.ajax({
                url: "{{ url('decrease') }}/" + productId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        // Update the quantity display
                        $('#qty-' + productId).text(response.qty);
                        $('#qty-' + productId).css('opacity', '1');
                    }

                    // Hide loading spinner and re-enable buttons
                    $('#loading-spinner-' + productId).hide();
                    $('.increase, .decrease').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating quantity:', error);
                    console.error('Response:', xhr.responseText);
                    alert('Failed to update quantity. Please try again.');

                    // Hide loading spinner and re-enable buttons
                    $('#loading-spinner-' + productId).hide();
                    $('#qty-' + productId).css('opacity', '1');
                    $('.increase, .decrease').prop('disabled', false);
                }
            });
        });
    </script>

@endpush
