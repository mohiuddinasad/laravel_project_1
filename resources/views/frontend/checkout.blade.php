@extends('frontend.layout')

@section('frontend_content')

@php
$cart = session('cart', []);
$totalAmount = 0;

@endphp

@foreach ($cart as $data)
@php
$totalAmount += $data['price'] * $data['qty']
@endphp

@endforeach





<!-- ========== Start billing ========== -->
<section id="billing">
    <div class="container">

        <form action="{{ route('frontend.pay') }}" method="post">
            @csrf

            <input type="hidden" value="{{ $totalAmount }}" id="total_amount" name="total_amount">
            <div class="row">
                <div class="col-lg-8 billing_form">
                    <div class="form_head">
                        <h4>Billing Information</h4>
                    </div>

                    <div class="row name_row">
                        <div class="col-lg-12 px-2">
                            <label for="name">
                                First name
                            </label>
                            <input name="name" type="text" placeholder="Your first name" id="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 px-2">
                            <label for="currency">
                                Currency
                            </label>
                            <select name="currency" id="currency" required>
                                <option value="" disabled selected>Select Currency</option>
                                <option value="BDT">Bangladeshi Taka (BDT)</option>
                                <option value="INR">Indian Rupee (INR)</option>
                                <option value="USD">US Dollar (USD)</option>
                                <option value="PKR">Pakistani Rupee (PKR)</option>
                                <option value="CNY">Chinese Yuan (CNY)</option>
                            </select>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-6 px-2">
                            <label for="email">Email</label>
                            <input type="text" placeholder="Email Address" name="email" id="email" required>
                        </div>
                        <div class="col-lg-6 px-2">
                            <label for="phone">Phone</label>
                            <input type="text" placeholder="Phone number" name="phone" id="phone" required>
                        </div>

                        <div class="col-12">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" placeholder="address"
                                class="form-control "></textarea>
                        </div>
                    </div>



                </div>
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3>Order Summary</h3>

                        @php
                        $cart = session('cart', []);
                        $totalAmount = 0;
                        @endphp

                        <div class="total_amount">

                            @forelse ($cart as $data)
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="{{ asset('storage/product_images/' . $data['image']) }}"
                                        alt="">
                                </div>
                                <div class="col-8">
                                    <p class="mb-0 pb-0">{{ $data['title'] }}</p>
                                    <span>Price : {{ $data['price'] }}</span>
                                    <span>Qty : {{ $data['qty'] }}</span>
                                </div>
                            </div>
                            @php
                            $totalAmount += $data['price'] * $data['qty']
                            @endphp
                            @empty
                            <p class="text-danger text-center">No data found!</p>
                            @endforelse


                            <p>Subtotal: <span id="checkoutSubtotal">$ {{ $totalAmount }}</span></p>
                            <p>Shipping: <span>Free</span></p>
                            <p>Total: <span id="checkoutTotal">$ {{ $totalAmount }}</span></p>
                        </div>
                        <h4 class="payment_head">Payment Method</h4>
                        <div class="payment_method">
                            <label><input id="cod" style="width: 15px; height: 15px;" type="radio" name="payment"
                                    value="cod" checked>
                                Cash on Delivery</label>
                            <label><input id="online" style="width: 15px; height: 15px;" type="radio" name="payment"
                                    value="online">
                                Online Payment </label>

                        </div>
                        <button type="submit" id="placeOrderBtn">Place Order</button>
                        <button type="button" class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                            token="if you have any token validation"
                            postdata="your javascript arrays or objects which requires in backend"
                            order="If you already have the transaction generated for current order"
                            endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- ========== End billing ========== -->

@endsection

@push('frontend_js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>


<!-- If you want to use the popup integration, -->
<script>
    let cod = $('#cod');
    let online = $('#online');
    let placeOrderBtn = $('#placeOrderBtn');
    let sslczPayBtn = $('#sslczPayBtn');

    placeOrderBtn.show();
    sslczPayBtn.hide();

    cod.on('change', function(){
        if(this.checked){
            placeOrderBtn.show();
            sslczPayBtn.hide();
        }
    })
    online.on('change', function(){
        if(this.checked){
            placeOrderBtn.hide();
            sslczPayBtn.show();
        }
    })

     $('#sslczPayBtn').on('click', function () {

        let obj = {};
        obj.name = $('#name').val();
        obj.phone = $('#phone').val();
        obj.email = $('#email').val();
        obj.address = $('#address').val();
        obj.total_amount = $('#total_amount').val();
        obj.currency = $('#currency').val();

        // inject data JUST BEFORE payment
        $(this).prop('postdata', obj);
    });


    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endpush
