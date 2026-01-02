@extends('frontend.layout')
@section('frontend_content')
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
    <!-- ========== Start billing ========== -->
    <section id="billing">
    <div class="container">
        <form action="{{ route('frontend.order.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8 billing_form">
                    <div class="form_head">
                        <h4>Billing Information</h4>
                    </div>

                    <div class="row name_row">
                        <div class="col-lg-4 px-2">
                            <label for="f-name">First name</label>
                            <input name="first_name" type="text" placeholder="Your first name" id="f-name" required>
                        </div>
                        <div class="col-lg-4 px-2">
                            <label for="l-name">Last name</label>
                            <input name="last_name" type="text" placeholder="Your last name" id="l-name" required>
                        </div>
                        <div class="col-lg-4 px-2">
                            <label for="c-name">Company Name <span class="option">(optional)</span></label>
                            <input name="company_name" type="text" placeholder="Company name" id="c-name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 px-2">
                            <label for="Address">Street Address</label>
                            <input name="address" type="text" id="Address" placeholder="Address" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 px-2">
                            <label for="country">Country / Region</label>
                            <select name="country" id="country" required>
                                <option value="" disabled selected>select</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                <option value="USA">USA</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="China">China</option>
                            </select>
                        </div>
                        <div class="col-lg-4 px-2">
                            <label for="state">States</label>
                            <select name="state" id="state" required>
                                <option value="" disabled selected>select</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Barishal">Barishal</option>
                                <option value="Sylhet">Sylhet</option>
                            </select>
                        </div>
                        <div class="col-lg-4 px-2">
                            <label for="zip">Zip code</label>
                            <input name="zip_code" type="text" placeholder="Zip code" id="zip" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 px-2">
                            <label for="Email">Email</label>
                            <input name="email" type="email" placeholder="Email Address" id="Email" required>
                        </div>
                        <div class="col-lg-6 px-2">
                            <label for="Phone">Phone</label>
                            <input name="phone" type="text" placeholder="Phone number" id="Phone" required>
                        </div>
                    </div>

                    <div class="check d-flex align-items-center">
                        <input style="width: 13px;" type="checkbox" id="Ship">
                        <label class="mb-0 ms-2" for="Ship">Ship to a different address</label>
                    </div>

                    <div class="additional">
                        <h4>Additional Info</h4>
                        <div class="order">
                            <label for="order">Order Notes (Optional)</label>
                            <textarea name="order_notes" id="order" style="height: 100px;" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3>Order Summary</h3>
                        <div class="order_items">
                            @foreach ($cart as $id => $data)
                            <div class="row product_checking align-items-center" style="width: 100%;">
                                <div class="col-3 image">
                                    <img class="img-fluid" src="{{ asset('storage/product_images/' . $data['image']) }}" alt="">
                                </div>
                                <div class="col-6 pr_name p-0">
                                    <h6>{{ $data['title'] }} x {{ $data['qty'] }}</h6>
                                </div>
                                <div class="col-3 pr_price p-0">
                                    <span>${{ $data['price'] }}</span>
                                </div>
                            </div>
                            @php
                                $totalAmount += $data['price'] * $data['qty'];
                            @endphp
                            @endforeach
                        </div>

                        <div class="total_amount">
                            <p>Subtotal: <span id="checkoutSubtotal">${{ $totalAmount }}</span></p>
                            <p>Shipping: <span>Free</span></p>
                            <p>Total: <span id="checkoutTotal">${{ $totalAmount }}</span></p>

                            <!-- Hidden input for total -->
                            <input type="hidden" name="total" value="{{ $totalAmount }}">
                        </div>

                        <h4 class="payment_head">Payment Method</h4>
                        <div class="payment_method">
                            <label>
                                <input name="payment_method" style="width: 15px; height: 15px;"
                                       type="radio" value="cod" required >
                                Cash on Delivery
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
    <!-- ========== End billing ========== -->
@endsection
