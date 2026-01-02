$(function () {
    $(document).ready(function () {
        $('.venobox').venobox({
            autoplay: true,
            ratio: '16x9'
        });
    });
    // popup section 


    // ====================cart and cart page ================================//


    $(function () {
        // ==== Select elements which may exist on the current page ====//
        const cartSidebar = document.getElementById("cartSidebar");
        const cartItemsEl = document.getElementById("cartItems");
        const cartSubtotalEl = document.getElementById("cartSubtotal");
        const headPrice = document.getElementById("price");
        const clearCartBtn = document.getElementById("clearCart");
        const closeCartBtn = document.getElementById("closeCart");

        const cartToggleDesktop = document.getElementById("cartToggleDesktop");
        const cartCountDesktop = document.getElementById("cartCountDesktop");
        const cartCountCartBar = document.getElementById("item_number");
        const cartHeadCount = document.getElementById("header_item");
        const cartToggleMobile = document.getElementById("cartToggleMobile");
        const cartCountMobile = document.getElementById("cartCountMobile");

        // Cart page elements (may not exist on index.html)
        const cartTableBody = document.getElementById("cartTableBody");
        const summarySubtotal = document.getElementById("summarySubtotal");
        const summaryTotal = document.getElementById("summaryTotal");
        const updateCartBtn = document.getElementById("updateCartBtn");

        // ==== Load cart from localStorage (array of items) ====
        // item: { id, name, price (number), img, quantity (int) }
        let cart = JSON.parse(localStorage.getItem("cart")) || [];



        // Save cart to localStorage
        function saveCart() {
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        // Calculate subtotal (sum of price * qty)
        function calculateSubtotal() {
            return cart.reduce((sum, it) => sum + (it.price * it.quantity), 0);
        }

        // Update badge counts (unique items only)
        function updateBadges() {
            const count = cart.length; // unique product count
            if (cartCountDesktop) cartCountDesktop.textContent = count;
            if (cartCountMobile) cartCountMobile.textContent = count;
            if (cartCountCartBar) cartCountCartBar.textContent = count;
            if (cartHeadCount) cartHeadCount.textContent = count;
        }

        // Render cart items inside sidebar (no plus/minus, only text qty and remove)
        function renderSidebar() {
            if (!cartItemsEl) return;
            cartItemsEl.innerHTML = "";

            if (cart.length === 0) {
                cartItemsEl.innerHTML = `<p style="color:var(--muted)">Your cart is empty.</p>`;
                cartSubtotalEl && (cartSubtotalEl.textContent = `$0.00`);

                return;
            }

            cart.forEach((item, idx) => {
                const itemEl = document.createElement("div");
                itemEl.className = "cart-item";
                itemEl.innerHTML = `
        <div class="row cart_item_row align-items-center">
           <div class="col-4 p-0 image"><a href="details.html"><img class="img-fluid" src="${item.img || ''}" alt="${item.name}"></a></div>
           <div class="info col-6">
             <h4>${item.name}</h4>
             <div class="quentity_price">
                <div class="muted"><span>${item.quantity} kg x</span></div>
                <div class="price"><span>${Number(item.price).toFixed(2)}</span></div>
             </div>
           </div>
           <div class="col-2 p-0 d-flex justify-content-end">
               <span class="remove_item"><iconify-icon class="remove" data-index="${idx}" title="Remove" icon="ic:round-close" width="18" height="18"></iconify-icon></span>
           </div>
           
        </div>
      `;
                cartItemsEl.appendChild(itemEl);
            });

            const subtotal = calculateSubtotal();
            document.getElementById("cartSubtotalNav").textContent = subtotal.toFixed(2);
            cartSubtotalEl && (cartSubtotalEl.textContent = `$${subtotal.toFixed(2)}`);
        }

        // Remove item by index (used in sidebar)
        function removeItem(index) {
            cart.splice(index, 1);
            saveCart();
            renderAll();
        }

        // Clear entire cart
        function clearCart() {
            cart = [];
            saveCart();
            renderAll();
        }

        // Add product (called from index.html product buttons)
        function addProductToCart(product) {
            // product = { id, name, price, img }
            const existing = cart.find(it => it.id === product.id);
            if (existing) {
                // if already exists, increase quantity but cap at 5
                if (existing.quantity < 5) {
                    existing.quantity += 1;
                }
            } else {
                cart.push({ ...product, quantity: 1 });
            }
            saveCart();
            renderAll();
        }

        // ==== CART PAGE RENDER (with plus/minus) ====
        function renderCartPage() {
            if (!cartTableBody) return;
            cartTableBody.innerHTML = "";

            if (cart.length === 0) {
                cartTableBody.innerHTML = `<p class="empty" colspan="5" padding:20px;text-align:center">Your cart is empty.</p>`;
                summarySubtotal && (summarySubtotal.textContent = `$0.00`);
                summaryTotal && (summaryTotal.textContent = `$0.00`);
                return;
            }

            cart.forEach((item, idx) => {
                const subtotal = (item.price * item.quantity).toFixed(2);
                const tr = document.createElement("section");
                tr.innerHTML = `
        <div class="row item_row align-items-center m-0" style="width: 100%;">
        
        <div class="prod-info col-5">
            <div class="prod_row row align-items-center">
                <div class="image col-6 p-0">
                    <a href="details.html"><img class="img-fluid" src="${item.img || ''}" alt="${item.name}"></a>
                </div>
                <div class="col-6">
                    <p>${item.name}</p>
                </div>
            </div>
            
        </div>
        
        <div class="col-lg-2 col-4 price_col"><span class="price">$${Number(item.price).toFixed(2)}</span></div><br>
        <div class="col-lg-2 p-0 quentity">
          <div class="qty-control" data-index="${idx}">
            <button class="qty-decrease" data-index="${idx}">-</button>
            <div class="qty-display" id="qty-${idx}">${item.quantity}</div>
            <button class="qty-increase" data-index="${idx}">+</button>
          </div>
        </div>
        <div class="col-2 order-3"><span class="total">$${subtotal}</span></div>
        <div class="col-1 order-3 item_remove"><span><iconify-icon class="remove-row" data-index="${idx}" icon="si:close-fill" width="24" height="24"></iconify-icon></span></div>
        </div>
      `;
                cartTableBody.appendChild(tr);
            });

            const subtotalVal = calculateSubtotal();
            summarySubtotal && (summarySubtotal.textContent = `$${subtotalVal.toFixed(2)}`);
            summaryTotal && (summaryTotal.textContent = `$${subtotalVal.toFixed(2)}`);
            headPrice && (headPrice.textContent = `$${subtotalVal.toFixed(2)}`);
        }

        // Increase quantity on cart page (max 5)
        function increaseQty(index) {
            const item = cart[index];
            if (!item) return;
            if (item.quantity < 5) {
                item.quantity += 1;
                saveCart();
                renderCartPage();
                renderSidebar(); // keep sidebar in sync
                updateBadges();
            }
        }

        // Decrease quantity on cart page (min 1)
        function decreaseQty(index) {
            const item = cart[index];
            if (!item) return;
            if (item.quantity > 1) {
                item.quantity -= 1;
                saveCart();
                renderCartPage();
                renderSidebar();
                updateBadges();
            }
        }

        // Remove item from cart page
        function removeFromCartPage(index) {
            cart.splice(index, 1);
            saveCart();
            renderAll();
        }

        // Update all visible parts (badges, sidebar, cart page)
        function renderAll() {
            updateBadges();
            renderSidebar();
            renderCartPage();
        }

        // ==== EVENT LISTENERS ====
        // ===== Toast Notification System =====
        function showToast(message, type = "error") {
            const toast = document.getElementById("toast");
            if (!toast) return;

            toast.textContent = message;
            toast.className = `toast-message show ${type}`;

            setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);
        }

        // Add to cart buttons (on index.html)
        document.querySelectorAll(".add-to-cart").forEach(btn => {
            btn.addEventListener("click", (e) => {
                const p = e.target.closest(".product");
                const id = p.dataset.id;
                const name = p.dataset.name;
                const price = parseFloat(p.dataset.price);
                const img = p.dataset.img || p.querySelector("img")?.src || "";
                const stock = p.dataset.stock === "true"; // true / false হিসেবে convert

                // 🧠 যদি product out of stock হয়, তাহলে add না করে alert দেখাবে
                if (!stock) {
                    showToast(`${name} is currently out of stock!`, "warning");
                    return;
                }


                addProductToCart({ id, name, price, img });
            });
        });


        // Sidebar remove (event delegation)
        if (cartItemsEl) {
            cartItemsEl.addEventListener("click", (e) => {
                if (e.target.classList.contains("remove")) {
                    const idx = Number(e.target.dataset.index);
                    removeItem(idx);
                }
            });
        }

        // Clear all button in sidebar
        if (clearCartBtn) clearCartBtn.addEventListener("click", clearCart);

        // Sidebar open/close toggles

        if (cartToggleDesktop) cartToggleDesktop.addEventListener("click", () => cartSidebar && cartSidebar.classList.add("active"));
        if (cartToggleMobile) cartToggleMobile.addEventListener("click", () => cartSidebar && cartSidebar.classList.add("active"));
        if (closeCartBtn) closeCartBtn.addEventListener("click", () => cartSidebar && cartSidebar.classList.remove("active"));

        // Cart page quantity controls and remove (event delegation)
        if (cartTableBody) {
            cartTableBody.addEventListener("click", (e) => {
                const target = e.target;
                const idx = target.dataset.index !== undefined ? Number(target.dataset.index) : null;

                if (target.classList.contains("qty-increase") && idx !== null) {
                    increaseQty(idx);
                } else if (target.classList.contains("qty-decrease") && idx !== null) {
                    decreaseQty(idx);
                } else if (target.classList.contains("remove-row") && idx !== null) {
                    removeFromCartPage(idx);
                }
            });
        }

        // Update Cart button (on cart page) - re-calc and save (most changes already saved live)
        if (updateCartBtn) {
            updateCartBtn.addEventListener("click", (e) => {
                // we already update on click, but provide an explicit save/render
                saveCart();
                renderAll();
                // simple feedback:
                updateCartBtn.textContent = "Updated";
                setTimeout(() => updateCartBtn.textContent = "Update Cart", 900);
            });
        }

        // Initial render
        renderAll();


        // =========================== CHECKOUT PAGE RENDER =========================== //


        const orderItems = document.getElementById("orderItems");
        const checkoutSubtotal = document.getElementById("checkoutSubtotal");
        const checkoutTotal = document.getElementById("checkoutTotal");
        const placeOrderBtn = document.getElementById("placeOrderBtn");

        function renderCheckout() {
            if (!orderItems) return; // যদি checkout page এ না থাকি, কিছু করবে না
            orderItems.innerHTML = "";
            let subtotal = 0;

            if (cart.length === 0) {
                orderItems.innerHTML = `<p class="empty">Your cart is empty.</p>`;
                checkoutSubtotal && (checkoutSubtotal.textContent = `$0.00`);
                checkoutTotal && (checkoutTotal.textContent = `$0.00`);
                return;
            }

            cart.forEach(item => {
                let li = document.createElement("div");
                li.innerHTML = `
                <div class="row product_checking align-items-center" style="width: 100%;">
                <div class="col-3 image"><img class="img-fluid" src="${item.img}" alt="${item.name}"></div>
                <div class="col-6 pr_name p-0"><h6>${item.name} x${item.quantity}</h6></div>
                <div class="col-3 pr_price p-0"><span>$${(item.price * item.quantity).toFixed(2)}</span></div>
                </div>`;
                orderItems.appendChild(li);

                subtotal += item.price * item.quantity;
            });

            checkoutSubtotal && (checkoutSubtotal.textContent = `$${subtotal.toFixed(2)}`);
            checkoutTotal && (checkoutTotal.textContent = `$${subtotal.toFixed(2)}`);
        }

        if (placeOrderBtn) {
            placeOrderBtn.addEventListener("click", () => {
                if (cart.length === 0) {
                    alert("Your cart is empty!");
                    return;
                }

                const paymentMethod = document.querySelector('input[name="payment"]:checked')?.value || "cod";
                console.log("Order Placed!", { cart, paymentMethod });

                alert("✅ Order placed successfully!");

                // Clear cart after order
                cart = [];
                saveCart();
                renderAll();
                renderCheckout();
            });
        }

        // Checkout page initial render
        renderCheckout();


    });

    //=========================== whislist ===========================
    $(function () {

        let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        function saveWishlist() { localStorage.setItem("wishlist", JSON.stringify(wishlist)); }
        function saveCart() { localStorage.setItem("cart", JSON.stringify(cart)); }

        function updateCounts() {
            document.querySelectorAll("#wishlistCount").forEach(el => el.textContent = wishlist.length);

        }

        // === INDEX PAGE ===
        document.querySelectorAll(".product").forEach(prod => {
            const id = prod.dataset.id;
            const name = prod.dataset.name;
            const price = parseFloat(prod.dataset.price);
            const img = prod.dataset.img;
            const stock = prod.dataset.stock === "true";



            prod.querySelector(".add-to-wishlist").addEventListener("click", () => {
                if (!wishlist.find(p => p.id === id)) {
                    wishlist.push({ id, name, price, img, stock });
                    saveWishlist(); updateCounts();
                }
            });
        });

        // === WISHLIST PAGE ===
        const wishlistTableBody = document.getElementById("wishlistTableBody");
        if (wishlistTableBody) {
            function renderWishlist() {
                wishlistTableBody.innerHTML = "";
                wishlist.forEach((item, idx) => {
                    const tr = document.createElement("section");
                    tr.innerHTML = `
          <div class="item_row row align-items-center"  data-stock="${item.stock}" data-id="${item.name}" data-name="${item.name}"
                    data-price="${item.price.toFixed(2)}" data-img="${item.img}">
          <div class="wish_body col-5 image_text d-flex align-items-center">
          <a href="./details.html"><img class="img-fluid" src="${item.img}" width="100" height="100"></a> 
          <div class="text"><h6>${item.name}</h6></div>
          </div>
          <div class="wish_body col-2 price"><span>$${item.price.toFixed(2)}</span></div>
          <div class="wish_body col-2 stock">
            ${item.stock
                            ? '<span class="stock-in">In Stock</span>'
                            : '<span class="stock-out">Out of Stock</span>'}
          </div>
          <div class="wish_body col-3 action d-flex align-items-center justify-content-end">
            <button class="${item.stock ? 'btn-green' : 'btn-disabled'} add-to-cart-wishlist" data-index="${idx}" ${item.stock ? "" : "disabled"}>Add to Cart</button>
            <span><iconify-icon class="remove-btn remove-wishlist" data-index="${idx}" icon="si:close-fill" width="24" height="24"></iconify-icon></span>
          </div>
          </div>
        `;
                    wishlistTableBody.appendChild(tr);
                });
            }
            renderWishlist();

            wishlistTableBody.addEventListener("click", e => {
                if (e.target.classList.contains("remove-wishlist")) {
                    wishlist.splice(e.target.dataset.index, 1);
                    saveWishlist(); renderWishlist(); updateCounts();
                }
                if (e.target.classList.contains("add-to-cart-wishlist")) {
                    const item = wishlist[e.target.dataset.index];
                    const existing = cart.find(p => p.id === item.id);
                    if (existing) existing.quantity++;
                    else cart.push({ ...item, quantity: 1 });
                    saveCart();
                    updateCounts();
                    renderWishlist(); // 🔥 add this line
                }

            });
        }



        updateCounts();

    });

    // Show popup after 3 seconds (if not disabled in session)
    $(function () {
        window.onload = function () {
            if (!sessionStorage.getItem("hidePopup")) {
                setTimeout(() => {
                    document.getElementById("popup").style.display = "flex";
                }, 3000);
            }
        };

        // Close button
        document.getElementById("closeBtn").onclick = function () {
            document.getElementById("popup").style.display = "none";

            // If checkbox is checked, save to sessionStorage
            if (document.getElementById("dontShow").checked) {
                sessionStorage.setItem("hidePopup", "true");
            }
        };

        // Click outside to close
        window.onclick = function (e) {
            if (e.target === document.getElementById("popup")) {
                document.getElementById("popup").style.display = "none";

                // If checkbox is checked, save to sessionStorage
                if (document.getElementById("dontShow").checked) {
                    sessionStorage.setItem("hidePopup", "true");
                }
            }
        };
    });


    // mobile search
    $(function () {

        let mobileSearch = document.querySelector('.search');
        let searchClose = document.querySelector(".close");
        let searchContain = document.querySelector("#search_contain")

        mobileSearch.addEventListener("click", function () {
            searchContain.classList.add("show")
        })
        searchClose.addEventListener("click", function () {
            searchContain.classList.remove("show")
        })
    });

    // banner 
    $('.banner_slide').slick({
        dots: true,
        autoplay: true,
        autoplaySpeed: 2500,
        nextArrow: `<span class="next"><iconify-icon icon="mynaui:arrow-right" width="24" height="24"></iconify-icon></span>`,
        prevArrow: `<span class="prev"><iconify-icon icon="mynaui:arrow-left" width="24" height="24"></iconify-icon></span>`
    });

    // filter 
    $('.category-button').categoryFilter();

    // product_image_slide

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        vertical: true,
        prevArrow: `<span class="up"><iconify-icon icon="iconamoon:arrow-up-2-light" width="24" height="24"></iconify-icon></span>`,
        nextArrow: `<span class="down"><iconify-icon icon="iconamoon:arrow-down-2-light" width="24" height="24"></iconify-icon></span>`,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    vertical: false,
                    arrows: false,
                }
            },
        ]

    });



    // pagination 
    $(document).ready(function () {
        generatePagination('.js-pagination', '.js-pagination-item', 12, '<iconify-icon icon="iconamoon:arrow-left-2" width="24" height="24"></iconify-icon>', '<iconify-icon icon="iconamoon:arrow-right-2" width="24" height="24"></iconify-icon>');
    });
    
    // countdown
    $('#getting-started').countdown('2029/01/01', function (event) {
        $(this).html(event.strftime('<span>%d <p>days</p></span> : <span>%H <p>Hours</p> </span>:<span>%M <p>MINS</p> </span>:<span>%S <p>Secs</p> </span>'));
    });
    // image_zoom
    $(function () {
        $(".example").imagezoomsl();
    });

    // touch_spin
    $("input[name='demo']").TouchSpin({
        min: 1,
        max: 5,
        decimals: 0,
        buttondown_txt: '-',
        buttonup_txt: '+',
        forcestepdivisibility: 'round',
        mousewheel: false,
    });

    // product_price
    $(".product").each(function () {
        let $product = $(this);
        let basePrice = parseFloat($product.find(".price").data("price"));
        let $priceElement = $product.find(".price_range");
        let $qtyInput = $product.find("input[name='demo']");

        function updatePrice() {
            let qty = parseInt($qtyInput.val());
            let total = (basePrice * qty).toFixed(2);
            $priceElement.text("$" + total);
        }

        // এখন stopspin event ব্যবহার করছি
        $qtyInput.on("change touchspin.on.stopspin", function () {
            updatePrice();
        });

        // শুরুতেই একবার call
        updatePrice();
    });

    // tabs 
    $(".js-tabs-link").aniTabs({
        animation: "slide",
        slideDirection: "left",
        autoHeight: true,
    });








});