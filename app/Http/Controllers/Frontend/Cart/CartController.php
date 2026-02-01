<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function cart()
    {
        return view('frontend.cart');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
        }

        return redirect()->route('frontend.cart');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
            session()->put('cart', $cart);
        }

        return redirect()->route('frontend.cart');
    }
}
