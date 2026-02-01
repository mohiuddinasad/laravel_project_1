@extends('frontend.layout')
@section('frontend_content')
    <!-- ========== Start breadcrumbs_bg ========== -->
    <section class="shop_bg" id="breadcrumbs_bg" class="py-3" style="background-image:none;">
        <div class="container">
            <div class="title">
                <p>

                    <span class="icon"><iconify-icon icon="bitcoin-icons:home-outline" width="24"
                            height="24"></iconify-icon></span>
                    >
                    <span>Categories</span>
                    >
                    <span>Vegetables</span>

                </p>
            </div>
        </div>
    </section>
    <!-- ========== End breadcrumbs_bg ========== -->
    <!-- ========== Start offer ========== -->
    <section id="offer">
        <div class="container"
            style="background-image: url({{ asset('frontend/assets/images/shop_bg.png') }}); height: 358px;">
            <div class="contain">
                <p>Best Deals</p>
                <h4>Sale of the Month</h4>
                <div id="getting-started"></div>
                <a href="">Shop Now <span><iconify-icon icon="lineicons:arrow-right" width="25"
                            height="25"></iconify-icon></span></a>
            </div>
        </div>
    </section>
    <!-- ========== End offer ========== -->
    <section id="all_product">
        <div class="container">
            <div class="row product_nav justify-content-between py-3">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-4 select_product px-2 pro_type">
                            <div class="filter_button">
                                <select class="form-select" id="categoryFilter" aria-label="Category filter">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 select_product px-2">
                            <select class="form-select" id="priceFilter" aria-label="Price filter">
                                <option value="">Select Price</option>
                                <option value="0-50">$0 - $50</option>
                                <option value="50-100">$50 - $100</option>
                                <option value="100-200">$100 - $200</option>
                                <option value="200+">$200+</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 text-end">
                    <p>Showing {{ $products->count() }} Products</p>


                </div>
            </div>

            <!-- Product Container -->
            <div class="row product_row justify-content-between" id="productContainer">
                @include('frontend.partials.product-list', ['products' => $products])
            </div>

            <!-- Loading Spinner -->
            <div class="text-center my-4 d-none" id="loadingSpinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <ul class="js-pagination"></ul>
        </div>
    </section>

    <!-- JavaScript for filtering -->
@endsection
@push('frontend_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('categoryFilter');
            const priceFilter = document.getElementById('priceFilter');
            const productContainer = document.getElementById('productContainer');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Function to fetch filtered products
            function fetchProducts() {
                const category = categoryFilter.value;
                const price = priceFilter.value;

                // Show loading spinner
                loadingSpinner.classList.remove('d-none');
                productContainer.style.opacity = '0.5';

                // Build query string
                const params = new URLSearchParams();
                if (category) params.append('category', category);
                if (price) params.append('price', price);

                // Fetch products via AJAX
                fetch(`{{ route('frontend.products.filter') }}?${params.toString()}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update product container
                        productContainer.innerHTML = data.html;

                        // Hide loading spinner
                        loadingSpinner.classList.add('d-none');
                        productContainer.style.opacity = '1';

                        console.log(`Found ${data.count} products`);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        loadingSpinner.classList.add('d-none');
                        productContainer.style.opacity = '1';
                        productContainer.innerHTML =
                            '<p class="text-center text-danger">Error loading products. Please try again.</p>';
                    });
            }

            // Add event listeners to all filters
            categoryFilter.addEventListener('change', fetchProducts);
            priceFilter.addEventListener('change', fetchProducts);
        });
    </script>
@endpush
