@extends('frontend.layout')
@section('frontend_content')
    <!-- ========== Start banner ========== -->
    <section id="banner">
        <div class="container">
            <div class="banner_slide">
                <div class="slider">
                    <div class="row align-items-center ">

                        <div class="image col-lg-6 justify-content-between ">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/banner/1.png') }}" alt="">
                            <div class="offer">
                                <h4>70%</h4>
                                <p>OFF</p>
                            </div>
                        </div>
                        <div class="contain col-lg-6">
                            <h5>Welcome to shopery</h5>
                            <h4>Fresh & Healthy Organic Food
                            </h4>
                            <p>Free shipping on all your order. we deliver, you enjoy</p>
                            <a href="">Shop now <span><iconify-icon icon="humbleicons:arrow-right" width="24"
                                        height="24"></iconify-icon></span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="slider">
                    <div class="row align-items-center ">

                        <div class="image col-lg-6 justify-content-between ">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/banner/2.png') }}" alt="">
                            <!-- <div class="offer">
                                        <h4>70%</h4>
                                        <p>OFF</p>
                                    </div> -->
                        </div>
                        <div class="contain col-lg-6">
                            <h5>Welcome to shopery</h5>
                            <h4>Fresh & Healthy Organic Food
                            </h4>
                            <p>Free shipping on all your order. we deliver, you enjoy</p>
                            <a href="">Shop now <span><iconify-icon icon="humbleicons:arrow-right" width="24"
                                        height="24"></iconify-icon></span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="slider">
                    <div class="row align-items-center ">

                        <div class="image col-lg-6 justify-content-between ">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/banner/3.png') }}" alt="">
                            <!-- <div class="offer">
                                        <h4>70%</h4>
                                        <p>OFF</p>
                                    </div> -->
                        </div>
                        <div class="contain col-lg-6">
                            <h5>Welcome to shopery</h5>
                            <h4>Fresh & Healthy Organic Food
                            </h4>
                            <p>Free shipping on all your order. we deliver, you enjoy</p>
                            <a href="">Shop now <span><iconify-icon icon="humbleicons:arrow-right" width="24"
                                        height="24"></iconify-icon></span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End banner ========== -->

    <!-- ========== Start featured ========== -->
    <section id="featured">
        <div class="container">
            <div class="row">
                <div class="featured_box col-lg-3">
                    <div class="icon">
                        <span><iconify-icon icon="la:shipping-fast" width="32" height="32"></iconify-icon></span>
                    </div>

                    <h4>Free Shipping</h4>
                    <p>Free shipping with discount</p>

                </div>

                <div class="featured_box col-lg-3">
                    <div class="icon">
                        <span><iconify-icon icon="streamline:customer-support-1" width="32"
                                height="32"></iconify-icon></span>
                    </div>

                    <h4>Great Support 24/7</h4>
                    <p>Instant access to Contact</p>

                </div>
                <div class="featured_box col-lg-3">
                    <div class="icon">
                        <span><iconify-icon icon="streamline-ultimate:shopping-bag-check" width="32"
                                height="32"></iconify-icon></span>
                    </div>

                    <h4>100% Sucure Payment</h4>
                    <p>We ensure your money is save</p>

                </div>
                <div class="featured_box col-lg-3">
                    <div class="icon">
                        <span><iconify-icon icon="fluent:box-24-regular" width="32" height="32"></iconify-icon></span>
                    </div>

                    <h4>Money-Back Guarantee</h4>
                    <p>30 days money-back guarantee</p>

                </div>
            </div>
        </div>
    </section>
    <!-- ========== End featured ========== -->


    <!-- ========== Start product ========== -->
    <section id="product">
        <div class="container">
            <div class="head">
                <h4>Introducing Our Products</h4>
                <div class="filter_button">
                    <button class="category-button" data-filter="all">All</button>
                    <button class="category-button" data-filter="vagetable"> Vegetable</button>
                    <button class="category-button" data-filter="fruit">Fruit</button>
                    <button class="category-button" data-filter="meat">Meat & Fish</button>
                </div>
            </div>

            <div class="row product_boxes">
                @forelse ($products as $product)
                    <div class="product filter_body col-lg-3 p-0">
                        <div class="filter fruit">
                            <span class="sale">Sale 50%</span>
                            <a href="{{ route('frontend.product.details', $product->slug) }}">
                                <img class="img-fluid" src="{{ asset('storage/product_images/' . $product->ProductImage->first()->image_name) }}" alt="">
                            </a>
                            <div class="details">
                                <div class="row justify-content-between align-items-center ">
                                    <div class="col-8">
                                        <h4 class="m-0">{{ $product->title }}</h4>
                                        <b>${{ $product->price }}</b>
                                        <del>$</del>
                                        <div class="rate">
                                            <ul>
                                                <li>
                                                    <iconify-icon icon="material-symbols-light:star" width="18"
                                                        height="18"></iconify-icon>
                                                </li>
                                                <li>
                                                    <iconify-icon icon="material-symbols-light:star" width="18"
                                                        height="18"></iconify-icon>
                                                </li>
                                                <li>
                                                    <iconify-icon icon="material-symbols-light:star" width="18"
                                                        height="18"></iconify-icon>
                                                </li>
                                                <li>
                                                    <iconify-icon icon="material-symbols-light:star" width="18"
                                                        height="18"></iconify-icon>
                                                </li>
                                                <li>
                                                    <iconify-icon icon="material-symbols-light:star" width="18"
                                                        height="18"></iconify-icon>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-4 bag_icon ">
                                       <a class="bag" href="{{ route('frontend.add.to.cart', $product->id) }}">
                                         <iconify-icon icon="teenyicons:bag-outline" width="24"
                                                height="24"></iconify-icon>
                                       </a>
                                    </div>
                                </div>
                            </div>
                            <span class="eye"><iconify-icon icon="bi:eye" width="20" height="20"></iconify-icon></span>
                            <span class="heart add-to-wishlist"><iconify-icon icon="bi:heart" width="20"
                                    height="20"></iconify-icon></span>
                        </div>
                    </div>
                @empty

                @endforelse
 
            </div>

        </div>
    </section>
    <!-- ========== End product ========== -->

    <!-- ========== Start drink ========== -->
    <section id="drink">
        <div class="container">
            <div class="row justify-content-between ">
                <div class="drink_banner col-lg-4">
                    <h4>100% Fresh <br> Cow Milk
                    </h4>
                    <p>Starting at <b>$14.99</b></p>
                    <a href="">Shop Now <span><iconify-icon icon="humbleicons:arrow-right" width="24"
                                height="24"></iconify-icon></span></a>
                </div>
                <div class="drink_banner_two col-lg-4">
                    <div>
                        <p>Drink Sale</p>
                        <h4>Water & <br> Soft Drink
                        </h4>
                        <a href="">Shop Now <span><iconify-icon icon="humbleicons:arrow-right" width="24"
                                    height="24"></iconify-icon></span></a>
                    </div>
                </div>
                <div class="drink_banner_three col-lg-4">
                    <div>
                        <p>100% Organic</p>
                        <h4>Quick <br> Breakfast</h4>
                        <a href="">Shop Now <span><iconify-icon icon="humbleicons:arrow-right" width="24"
                                    height="24"></iconify-icon></span></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ========== End drink ========== -->

    <!-- ========== Start time ========== -->
    <section id="time">
        <div class="container">
            <div class="contain">
                <p>Best Deals</p>
                <h4>Our Special Products <br> Deal of the Month</h4>
                <div id="getting-started"></div>
                <a href="">Shop now <span class="icon"><iconify-icon icon="mingcute:arrow-right-line" width="24"
                            height="24"></iconify-icon></span></a>
            </div>
        </div>
    </section>
    <!-- ========== End time ========== -->

    <!-- ========== Start featured_products ========== -->
    <section id="featured_products">
        <div class="container">
            <div class="head">
                <h4>Featured Products</h4>
            </div>
            <div class="row justify-content-between">
                <div class="product filter_body col-lg-2 p-0" data-stock="false" data-id="Green Apple"
                    data-name="Green Apple" data-price="14.99"
                    data-img="{{ asset('frontend/assets/images/filter/1.png') }}">
                    <div class="filter_box">
                        <span class="sale">Sale 50%</span>
                        <a href="./details.html">
                            <img class="img-fluid" style="height: 230px;"
                                src="{{ asset('frontend/assets/images/filter/1.png') }}" alt="">
                        </a>
                        <div class="details">
                            <div class="row justify-content-between align-items-center ">
                                <div class="col-8">
                                    <h4 class="m-0">Green Apple</h4>
                                    <b>$14.99</b>
                                    <del>$20.99</del>
                                    <div class="rate">
                                        <ul>
                                            <li>
                                                <iconify-icon icon="material-symbols-light:star" width="16"
                                                    height="16"></iconify-icon>
                                            </li>
                                            <li>
                                                <iconify-icon icon="material-symbols-light:star" width="16"
                                                    height="16"></iconify-icon>
                                            </li>
                                            <li>
                                                <iconify-icon icon="material-symbols-light:star" width="16"
                                                    height="16"></iconify-icon>
                                            </li>
                                            <li>
                                                <iconify-icon icon="material-symbols-light:star" width="16"
                                                    height="16"></iconify-icon>
                                            </li>
                                            <li>
                                                <iconify-icon icon="material-symbols-light:star" width="16"
                                                    height="16"></iconify-icon>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-4 bag_icon ">
                                    <span class="bag add-to-cart"><iconify-icon icon="teenyicons:bag-outline" width="18"
                                            height="18"></iconify-icon></span>
                                </div>
                            </div>
                        </div>
                        <span class="eye"><iconify-icon icon="bi:eye" width="18" height="18"></iconify-icon></span>
                        <span class="heart add-to-wishlist"><iconify-icon icon="bi:heart" width="18"
                                height="18"></iconify-icon></span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ========== End featured_products ========== -->


    <!-- ========== Start ad ========== -->
    <section class="popup-overlay" id="popup">
        <div class="row popup">
            <div class="popup-img col-lg-4">
                <div class="image"><img class="img-fluid" src="{{ asset('frontend/assets/images/ad image.png') }}"
                        alt="Newsletter"></div>
            </div>
            <div class="popup-content col-lg-6">
                <div class="details">
                    <span class="close" id="closeBtn"><iconify-icon icon="material-symbols:close-rounded" width="24"
                            height="24"></iconify-icon></span>
                    <h2>Subscribe to Our Newsletter</h2>
                    <p>Subscribe to our newsletter and Save your <b>20% <br> money</b> with discount code today.</p>
                    <div class="parent_form">
                        <form action="">
                            <input class="email" type="email" placeholder="Enter your email">
                            <button>Subscribe</button>
                        </form>
                    </div>

                    <!-- Checkbox -->
                    <div class="checkbox-container">
                        <input type="checkbox" id="dontShow">
                        <label for="dontShow">Do not show this window</label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End ad ========== -->
    <!-- ========== Start clints ========== -->
    <section id="client">
        <div class="container">
            <div class="head">
                <h4>What our Clients Says</h4>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4 p-0 box_wraper">
                    <div class="client_box">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/clients/icon.png') }}" alt="">
                        </div>
                        <div class="contain">
                            <p>
                                “Aenean et nisl eget eros consectetur vestibulum vel id erat. Aliquam feugiat massa
                                dui.
                                Sed
                                sagittis diam sit amet ante sodales semper. Aliquam commodo lorem laoreet ultricies
                                ele.
                                ”
                            </p>
                        </div>
                    </div>
                    <div class="customers">
                        <img src="{{ asset('frontend/assets/images/clients/1.png') }}" alt="">
                        <h5>Jenny Wilson</h5>
                        <span>Customer</span>
                    </div>
                </div>
                <div class="col-lg-4 p-0 box_wraper">
                    <div class="client_box">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/clients/icon.png') }}" alt="">
                        </div>
                        <div class="contain">
                            <p>
                                “Proin sed neque nec tellus malesuada ultrices eget a justo. Nullam a nibh faucibus,
                                semper risus ac, ultricies est. Maecenas eget purus in enim imperdiet dapibus in ac
                                mi.
                                Fusce faucibus lacus felis”
                            </p>
                        </div>
                    </div>
                    <div class="customers">
                        <img src="{{ asset('frontend/assets/images/clients/2.png') }}" alt="">
                        <h5>Guy Hawkins</h5>
                        <span>Customer</span>
                    </div>
                </div>
                <div class="col-lg-4 p-0 box_wraper">
                    <div class="client_box">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/clients/icon.png') }}" alt="">
                        </div>
                        <div class="contain">
                            <p>
                                “Nam sed odio diam. Mauris sagittis sapien sed convallis cursus. Proin mattis
                                ultrices
                                urna ac eleifend. Cras vel nisi nec lectus sagittis venenatis. Curabitur laoreet leo
                                sed
                                lorem pulvina”
                            </p>
                        </div>
                    </div>
                    <div class="customers">
                        <img src="{{ asset('frontend/assets/images/clients/3.png') }}" alt="">
                        <h5>Kathryn Murphy</h5>
                        <span>Customer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End clints ========== -->
    <!-- ========== Start vedio ========== -->
    <section id="vedio">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <a class="venobox" data-gall="gall-video" data-autoplay="true" data-vbtype="video" data-ratio="4x3"
                        href="https://youtu.be/O8t5xxOYa6w">
                        <img class="img-fluid" src="{{ asset('frontend/assets/images/thumble.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End vedio ========== -->

    <!-- ========== Start news ========== -->
    <section id="news">
        <div class="container">
            <div class="head">
                <h4>Latest News</h4>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4 news_box">
                    <div class="image">
                        <img class="img-fluid" src="{{ asset('frontend/assets/images/news/1.png') }}" alt="">
                    </div>
                    <div class="contain">
                        <h4>Curabitur porttitor orci eget neque accumsan venenatis.</h4>
                        <p>Nulla libero lorem, euismod venenatis nibh sed, sodales dictum ex. Etiam nisi augue,
                            malesuada et pulvinar at, posuere eu neque.</p>
                        <a href="">Read More <span><iconify-icon icon="mynaui:arrow-right" width="24"
                                    height="24"></iconify-icon></span></a>
                    </div>
                </div>
                <div class="col-lg-4 news_box">
                    <div class="image">
                        <img class="img-fluid" src="{{ asset('frontend/assets/images/news/2.png') }}" alt="">
                    </div>
                    <div class="contain">
                        <h4>Curabitur porttitor orci eget neque accumsan venenatis.</h4>
                        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia
                            consequat duis enim velit mollit. </p>
                        <a href="">Read More <span><iconify-icon icon="mynaui:arrow-right" width="24"
                                    height="24"></iconify-icon></span></a>
                    </div>
                </div>
                <div class="col-lg-4 news_box">
                    <div class="image">
                        <img class="img-fluid" src="{{ asset('frontend/assets/images/news/3.png') }}" alt="">
                    </div>
                    <div class="contain">
                        <h4>Curabitur porttitor orci eget neque accumsan venenatis.</h4>
                        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia
                            consequat duis enim velit mollit. </p>
                        <a href="">Read More <span><iconify-icon icon="mynaui:arrow-right" width="24"
                                    height="24"></iconify-icon></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End news ========== -->
    <!-- ========== Start news_latter ========== -->
    <section id="news_latter">
        <div class="container">
            <div class="row py-3 justify-content-between align-items-center">
                <div class="col-lg-2">
                    <div class="logo">
                        <img class="img-fluid" src="{{ asset('frontend/assets/images/Logo.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="subcribe">
                        <h4>Subcribe our Newsletter</h4>
                        <p>Pellentesque eu nibh eget mauris congue mattis matti.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form action="">
                        <input type="text" placeholder="Your email address">
                        <button>Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End news_latter ========== -->
@endsection
