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
    <section id="breadcrumbs_bg" style="background-image: url({{ asset('frontend/assets/images/details_bg.png') }});">
        <div class="container">
            <div class="title">
                <p>

                    <span class="icon"><iconify-icon icon="bitcoin-icons:home-outline" width="24"
                            height="24"></iconify-icon></span>
                    >
                    <span>cart</span>

                </p>
            </div>
        </div>
    </section>
    <!-- ========== End breadcrumbs_bg ========== -->


    <section id="cart_summary">
        <div class="container">
            <div class="head">
                <h4>My Shopping Cart</h4>
            </div>
            <div class="row cart-page container justify-content-between m-0">
                <div class="cart-table-wrap col-lg-8">
                    <!-- Table-like layout -->
                    <div class="cart-table" id="cartTable">
                        <div class="row justify-content-between title-row" style="width: 100%;">
                            <span class="col-5 text">PRODUCT</span>
                            <span class="col-2 text">PRICE</span>
                            <span class="col-2 text p-0">QUANTITY</span>
                            <span class="col-2 text subtotal_head">SUBTOTAL</span>
                            <span class="col-1"></span>
                        </div>
                        <div id="">

                            @forelse ($cart as $id => $data)

                                <div class="row item_row align-items-center m-0" style="width: 100%;">

                                    <div class="prod-info col-5">
                                        <div class="prod_row row align-items-center">
                                            <div class="image col-6 p-0">
                                                <a href=""><img class="img-fluid"
                                                        src="{{ asset('storage/product_images/' . $data['image']) }}"
                                                        alt="{{ $data['title'] }}"></a>
                                            </div>
                                            <div class="col-6">
                                                <p>{{ $data['title'] }}</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-2 col-4 price_col"><span class="price">{{ $data['price'] }}</span></div>
                                    <br>
                                    <div class="col-lg-2 p-0 quentity">
                                        <div class="qty-control">
                                             <form action="{{ route('frontend.cart.decrease', $id) }}" method="POST">@csrf

                                                 <button type="submit" class="qty-decrease decrease">-</button>
                                             </form>
                                            <div id="qty-{{ $id }}" class="qty-display">{{ $data['qty'] }}</div>
                                            <form action="{{ route('frontend.cart.increase', $id) }}" method="POST">@csrf
                                                <button type="submit" class="qty-increase increase">+</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-2 order-3"><span class="total">{{ $data['price'] * $data['qty'] }}</span>
                                    </div>

                                    <a href="{{ route('frontend.remove.cart', $id) }}" class="col-1 order-3 item_remove">

                                        <span><iconify-icon class="remove-row" icon="si:close-fill" width="24"
                                                height="24"></iconify-icon></span>
                                    </a>
                                </div>
                            @empty
                            <div class="row item_row align-items-center my-2" style="width: 100%;">
                                <h4 class="text-center text-danger">Your cart is empty.</h4>
                            </div>
                            @endforelse
                        </div>
                        <div class="cart-controls">
                            <div class="return">
                                <a href="index.html" class="">Return to shop</a>
                            </div>
                            <div class="update"><button id="updateCartBtn">Update Cart</button></div>
                        </div>
                    </div>
                    <div class="cupon row align-items-center m-0">
                        <div class="text col-lg-3 p-0">
                            <span>Coupon Code</span>
                        </div>
                        <div class="col-lg-9 p-0">
                            <form action="">
                                <input type="text" placeholder="Enter code">
                                <button>Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 cart-summary">
                    <div class="box">
                        <h3>Cart Total</h3>
                        <div class="summary-row"><span>Subtotal:</span><span class="subtotal"
                                id="summarySubtotal">${{ $totalAmount }}</span></div>
                        <div class="summary-row"><span>Shipping:</span><span class="free">Free</span></div>
                        <div class="summary-total"><span>Total:</span><b id="summaryTotal">${{ $totalAmount }}</b></div>
                        <a href="{{ route('frontend.checkout') }}" class="checkout-btn">
                            Proceed to checkout
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('frontend_js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).on('click', '.increase', function () {
            let id = $(this).data('id');

            $.ajax({
                url: "/cart/update",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    type: "increase"
                },
                success: function (res) {
                    $('#qty-' + id).text(res.qty);
                    $('#price-' + id).text(res.total);
                }
            });
        });

        $(document).on('click', '.decrease', function () {
            let id = $(this).data('id');

            $.ajax({
                url: "/cart/update",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    type: "decrease"
                },
                success: function (res) {
                    $('#qty-' + id).text(res.qty);
                    $('#price-' + id).text(res.total);
                }
            });
        });
    </script>

@endpush
