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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- GOOGLE FONTS END -->

    <title>Ecobazar | Home</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/fav.png') }}" type="image/x-icon">

    <!-- SLICK SLIDER -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/anitabs.css') }}">
    <!-- BOOTSTRAP 5.3 -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <!-- veno_box -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.css') }}">
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <!-- RESPONSIVE CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-left: .1rem;
            display: none;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }
    </style>

    @stack('frontend_css')
</head>

<body>


    <!-- =============== HEADING START ==================== -->
    <section id="heading">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-5  d-flex align-items-center">
                    <span class="location"><iconify-icon icon="fluent:location-28-regular" width="20"
                            height="20"></iconify-icon></span>
                    <span class="location_text">Store Location: Lincoln- 344, Illinois, Chicago, USA</span>
                </div>

                <div class="col-lg-4 heading_right">
                    <div>
                        <select name="" id="">
                            <option value="">Bng</option>
                            <option value="">Eng</option>
                        </select>

                        <select name="" id="">
                            <option value="">BDT</option>
                            <option value="">USD</option>
                        </select>
                    </div>
                    <span class="divider"></span>
                    <div class="heading_right_secondary">
                        <a href="#">Sign In</a>
                        <span class="slash">/</span>
                        <a href="#">Sign Up</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- =============== HEADING END ==================== -->



    <!-- =============== HEADING TWO START ==================== -->
    <section id="secondary_heading" class="py-3">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="logo col-lg-3">
                    <a href="{{ route('frontend.home') }}">
                        <img src="{{ asset('frontend/assets/images/Logo.png') }}" alt="logo.png">
                    </a>
                </div>
                <div class="col-lg-5">
                    <form action="" method="GET" class="search_bar" id="searchForm">
                        @csrf
                        <span class="search_icon">
                            <iconify-icon icon="uil:search" width="20" height="21"></iconify-icon>
                        </span>
                        <input type="text" id="searchInput" name="query" value="{{ request('query') }}"
                            placeholder="Search products..." autocomplete="off">
                        <button type="submit" class="search_btn">Search</button>
                    </form>


                </div>
                <div class="col-lg-3">
                    <div class="cart_parent">
                        <div class="wishlist_icon">
                            <a href="wishlist.html"><span><iconify-icon icon="bi:heart" width="35"
                                        height="33"></iconify-icon></span></a>
                            <!-- <span id="wishlistCount">0</span> -->
                        </div>

                        <div class="second_divider"></div>
                        <div class="shopping_bag">
                            <span style="cursor: pointer;" class="cart-icon" id="cartToggleDesktop"><iconify-icon
                                    icon="teenyicons:bag-outline" width="30" height="30"></iconify-icon></span>
                            <span class="count cart-badge">{{ $qty ? $qty : 0 }}</span>
                            <div class="shop">
                                <p class="shopping_text mb-0">Shopping cart:</p>
                                <b class="price">${{ $totalAmount }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== HEADING TWO END ==================== -->

    <!-- ========== Start nav ========== -->
    <nav id="nav" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="d-lg-none" href=""><img src="{{ asset('frontend/assets/images/Logo.png') }}"
                    alt=""></a>
            <div class="d-none d-lg-block">
                <div class="dropdown category-dropdown">
                    <button class="btn category-dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <iconify-icon icon="material-symbols-light:menu-rounded" width="24"
                            height="24"></iconify-icon>
                        <span class="categories-text">All Categories</span>
                        <iconify-icon icon="iconamoon:arrow-down-2-duotone" width="24" height="24"
                            class="arrow-icon"></iconify-icon>
                    </button>

                    <ul class="dropdown-menu category-menu">
                        @foreach ($categories as $category)
                            @include('frontend.partials.category-menu', ['category' => $category])
                        @endforeach
                    </ul>
                </div>

            </div>

            <button class="menu_icon d-lg-none navbar-toggler" type="button" data-bs-toggle="offcanvas"
                href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <iconify-icon icon="ic:outline-menu" width="33" height="33"></iconify-icon>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Home <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                                height="24"></iconify-icon>
                        </a>
                        <ul class="dropdown-menu child">
                            <li><a class="dropdown-item" href="index.html">Home-1</a></li>
                            <li><a class="dropdown-item" href="index.html">Home-2</a></li>
                            <li><a class="dropdown-item" href="index.html">Home-3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown_bar" href="{{ route('frontend.shop') }}" role="button">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pages <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                                height="24"></iconify-icon>
                        </a>
                        <ul class="dropdown-menu child">
                            <li><a class="dropdown-item" href="#">Pages-1</a></li>
                            <li><a class="dropdown-item" href="#">Pages-2</a></li>
                            <li>
                            </li>
                            <li><a class="dropdown-item" href="#">Pages-3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Blog <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                                height="24"></iconify-icon>
                        </a>
                        <ul class="dropdown-menu child">
                            <li><a class="dropdown-item" href="#">Blog-1</a></li>
                            <li><a class="dropdown-item" href="#">Blog-2</a></li>
                            <li>
                            </li>
                            <li><a class="dropdown-item" href="#">Blog-3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_link" href="">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_link" href="">Contact Us</a>
                    </li>
                </ul>
                <div class="call">
                    <a href="">
                        <iconify-icon icon="lucide:phone-call" width="24" height="24"></iconify-icon>
                        <span>(219)
                            555-0114</span></a>
                </div>

            </div>
        </div>
    </nav>
    <!-- ========== End nav ========== -->

    <!-- ========== Start offcanvas ========== -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <a href="index.html">
                <img class="img-fluid" src="{{ asset('frontend/assets/images/Logo.png') }}" alt="">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Home</span>
                        <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                            height="24"></iconify-icon>
                    </a>
                    <ul class="dropdown-menu child">
                        <li><a class="dropdown-item" href="index.html">Home-1</a></li>
                        <li><a class="dropdown-item" href="index.html">Home-2</a></li>
                        <li>
                        </li>
                        <li><a class="dropdown-item" href="index.html">Home-3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Shop</span>
                        <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                            height="24"></iconify-icon>
                    </a>
                    <ul class="dropdown-menu child">
                        <li><a class="dropdown-item" href="shop.html">Shop-1</a></li>
                        <li><a class="dropdown-item" href="shop.html">Shop-2</a></li>
                        <li><a class="dropdown-item" href="shop.html">Shop-3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Pages</span>
                        <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                            height="24"></iconify-icon>
                    </a>
                    <ul class="dropdown-menu child">
                        <li><a class="dropdown-item" href="#">Pages-1</a></li>
                        <li><a class="dropdown-item" href="#">Pages-2</a></li>
                        <li>
                        </li>
                        <li><a class="dropdown-item" href="#">Pages-3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown_bar" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Blog</span>
                        <iconify-icon icon="iconamoon:arrow-down-2-light" width="24"
                            height="24"></iconify-icon>
                    </a>
                    <ul class="dropdown-menu child">
                        <li><a class="dropdown-item" href="#">Blog-1</a></li>
                        <li><a class="dropdown-item" href="#">Blog-2</a></li>
                        <li>
                        </li>
                        <li><a class="dropdown-item" href="#">Blog-3</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav_link" href="">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav_link" href="">Contact Us</a>
                </li>
            </ul>
            <div class="heading_right_secondary">
                <a href="#">Sign In</a>
                <a href="#">Sign Up</a>
            </div>
        </div>
    </div>
    <!-- ========== End offcanvas ========== -->

    <!-- ========== Start mobile_footer ========== -->
    <section id="mobile_footer" class=" d-lg-none shadow ">
        <div class="container">
            <div class="row justify-content-between ">
                <div class="col-3 home">
                    <a href="index.html"><iconify-icon icon="ic:baseline-home" width="30"
                            height="30"></iconify-icon></a>
                    <p>home</p>
                </div>
                <div class="col-3 category" style="padding-top: 6px;">
                    <a href="wishlist.html"><iconify-icon icon="bi:heart" width="26"
                            height="26"></iconify-icon></a>
                    <p>Wishlist</p>
                </div>
                <div class="col-3 search">
                    <span><iconify-icon icon="weui:search-filled" width="30"
                            height="30"></iconify-icon></span>
                    <p>Search</p>
                </div>
                <div class="cart col-3">
                    <div class="cart-container">
                        <span class="cart-icon" id="cartToggleMobile"><iconify-icon icon="teenyicons:bag-outline"
                                width="30" height="30"></iconify-icon></span>
                        <span id="cartCountMobile" class="cart-badge">0</span>
                    </div>
                    <p>Cart</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End mobile_footer ========== -->
    <!-- ========== Start search_contain ========== -->
    <section id="search_contain" class="d-lg-none">
        <div class="container">
            <form action="">
                <input type="text" placeholder="search">
                <button type="submit"><iconify-icon icon="weui:search-filled" width="24"
                        height="24"></iconify-icon></button>
                <span class="close"><iconify-icon icon="line-md:close" width="24"
                        height="24"></iconify-icon></span>
            </form>

            <div class="filter_card">
                <div class="row g-3 my-2">
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/1.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Green Apple</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/2.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Surjapur Mango</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/3.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Red Tomatos</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/4.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Eggplant</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/4.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Eggplant</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/4.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Eggplant</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/4.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Eggplant</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                    <div class="card_box col-6">
                        <div class="card_contain shadow">
                            <img class="img-fluid" src="{{ asset('frontend/assets/images/search_img/4.png') }}"
                                alt="">
                            <div class="details">
                                <h4>Eggplant</h4>
                                <b>$14.99</b>
                                <del>$20.99</del>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ========== End search_contain ========== -->

    <!-- Notification Toast -->
    <div id="toast" class="toast-message"></div>


    @php
        $cart = session('cart', []);
        $qty = array_sum(array_column($cart, 'qty'));
    @endphp

    <!-- ========== Start cart_sidebar ========== -->
    <aside class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Shopping Cart <span>(<b id="">{{ $qty ? $qty : 0 }}</b>)</span></h3>
            <button id="closeCart" class="close_btn btn-close"></button>
        </div>

        @php
            $totalAmount = 0;
        @endphp
        <div class="cart-items">
            @forelse ($cart as $id => $data)
                <div class="row cart_item_row align-items-center">
                    <div class="col-4 p-0 image"><a href="details.html"><img class="img-fluid"
                                src="{{ asset('storage/product_images/' . $data['image']) }}" alt=""></a>
                    </div>
                    <div class="info col-6">
                        <h4>{{ $data['title'] }}</h4>
                        <div class="quentity_price">
                            <div class="muted"><span> {{ $data['qty'] }}kg x</span></div>
                            <div class="price"><span>{{ $data['price'] }}</span></div>
                        </div>
                    </div>
                    <div class="col-2 p-0 d-flex justify-content-end">
                        <a class="remove_item" href="{{ route('frontend.remove.cart', $id) }}">
                            <iconify-icon class="remove" title="Remove" icon="ic:round-close" width="18"
                                height="18"></iconify-icon>
                        </a>
                    </div>
                    @php
                        $totalAmount += $data['price'] * $data['qty'];
                    @endphp
                </div>
            @empty
                <p><span class="empty-cart text-danger">Your cart is empty</span></p>
            @endforelse
        </div>

        <div class="cart-footer">
            <div class="subtotal-row">
                <div>
                    <span>{{ $qty ? $qty : 0 }}</span>
                    <span>products</span>
                </div>
                <div>
                    <strong id="cartSubtotal">${{ $totalAmount }}</strong>
                </div>
            </div>

            <div class="cart-actions">
                <a class="checkout" href="{{ route('frontend.checkout') }}">Checkout</a>
                <a class="" href="{{ route('frontend.cart') }}" id="goToCart" class="btn primary">Go to
                    Cart</a>
            </div>
        </div>
    </aside>
    <!-- ========== End cart_sidebar ========== -->


    @yield('frontend_content')

    <!-- ========== Start footer ========== -->
    <footer id="footer">
        <div class="container">
            <div class="row first_row">
                <div class="col-lg-4 first">
                    <a href="./index.html">
                        <img class="img-fluid" src="{{ asset('frontend/assets/images/footer_logo.png') }}"
                            alt="">
                    </a>
                    <p class="contain">Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget
                        bibendum magna congue nec.</p>
                    <p><b>(219) 555-0114</b> or <b>Proxy@gmail.com</b></p>
                </div>
                <div class="col-lg-2 last">
                    <div>
                        <div class="head">
                            <h4>My Account</h4>
                        </div>
                        <ul>
                            <li><a href="">My Account</a></li>
                            <li><a href="">Order History</a></li>
                            <li><a href="">Shoping Cart</a></li>
                            <li><a href="">Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 last">
                    <div>
                        <div class="head">
                            <h4>Helps</h4>
                        </div>
                        <ul>
                            <li><a href="">Contact</a></li>
                            <li><a href="">Faqs</a></li>
                            <li><a href="">Terms & Condition</a></li>
                            <li><a href="">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 last">
                    <div>

                        <div class="head">
                            <h4>Proxy</h4>
                        </div>
                        <ul>
                            <li><a href="">About</a></li>
                            <li><a href="">Shop</a></li>
                            <li><a href="">Product</a></li>
                            <li><a href="">Track Order</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 last">
                    <div>

                        <div class="head">
                            <h4>Categories</h4>
                        </div>
                        <ul>
                            <li><a href="">Fruit & Vegetables</a></li>
                            <li><a href="">Meat & Fish</a></li>
                            <li><a href="">Bread & Bakery</a></li>
                            <li><a href="">Beauty & Health</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row secondary_row justify-content-between">
                <div class="col-lg-4 order-2 order-lg-1">
                    <div class="footer_title">
                        <p>Ecobazar eCommerce © 2021. All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="payment">
                        <a href=""><img src="{{ asset('frontend/assets/images/payment/1.png') }}"
                                alt=""></a>
                        <a href=""><img src="{{ asset('frontend/assets/images/payment/2.png') }}"
                                alt=""></a>
                        <a href=""><img src="{{ asset('frontend/assets/images/payment/3.png') }}"
                                alt=""></a>
                        <a href=""><img src="{{ asset('frontend/assets/images/payment/4.png') }}"
                                alt=""></a>
                        <a href=""><img src="{{ asset('frontend/assets/images/payment/5.png') }}"
                                alt=""></a>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <!-- ========== End footer ========== -->







    <script>
        document.querySelectorAll('.dropdown-submenu > a').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile submenu toggle
            if (window.innerWidth <= 768) {
                document.querySelectorAll('.dropdown-submenu > .dropdown-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const parent = this.closest('.dropdown-submenu');
                        parent.classList.toggle('active');
                    });
                });
            }
        });
    </script>


    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- ICONIFY -->
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.js') }}"></script>
    <!-- SLICK SLIDER JS -->
    <script src="{{ asset('frontend/assets/js/slick.min.js ') }}"></script>
    <!-- filters -->
    <script src="{{ asset('frontend/assets/js/category-filter.js') }}"></script>
    <!-- timer -->
    <script src="{{ asset('frontend/assets/js/syotimer.examples.js') }}"></script>
    <!-- veno_box_js -->
    <script src="{{ asset('frontend/assets/js/venobox.js') }}"></script>
    <!-- APP JS -->
    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
    <!-- image_zoom -->
    <script src="{{ asset('frontend/assets/js/zoomsl.js') }}"></script>
    <!-- tabs  -->
    <script src="{{ asset('frontend/assets/js/anitabs.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.bootstrap-touchspin.js') }}"></script>


    @stack('frontend_js')

</body>

</html>
