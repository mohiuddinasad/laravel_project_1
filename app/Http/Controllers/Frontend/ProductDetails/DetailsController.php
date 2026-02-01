<?php

namespace App\Http\Controllers\Frontend\ProductDetails;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;

class DetailsController extends Controller
{
    public function productDetails($slug)
    {
        $product = Product::with('ProductImage')
            ->where('slug', $slug)
            ->firstOrFail();

        $cart = session('cart', []);
        $qty = array_sum(array_column($cart, 'qty'));

        return view('frontend.details', compact('product', 'cart', 'qty'));
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']+= 1;
        } else {
            $productCart = Product::with('ProductImage')->find($id);

            $cart[$id] = [
                'title'          => $productCart->title,
                'price'          => $productCart->price,
                'discount_price' => $productCart->discount_price,
                'qty'            => 1,
                'image'          => $productCart->ProductImage[0]->image_name ?? null,
                'descriptions'   => $productCart->descriptions,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'qty'     => $cart[$id]['qty'],
            'total'   => $cart[$id]['price'] * $cart[$id]['qty'],
        ]);
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['qty'] > 1) {
                $cart[$id]['qty']-= 1;
                session()->put('cart', $cart);

                return response()->json([
                    'success' => true,
                    'qty'     => $cart[$id]['qty'],
                    'total'   => $cart[$id]['price'] * $cart[$id]['qty'],
                ]);
            } else {
                unset($cart[$id]);
                session()->put('cart', $cart);

                return response()->json([
                    'success' => true,
                    'qty'     => 0,
                    'total'   => 0,
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not in cart',
        ]);
    }
}