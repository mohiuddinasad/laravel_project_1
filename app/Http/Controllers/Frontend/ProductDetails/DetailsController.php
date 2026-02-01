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

        return view('frontend.details', compact('product'));
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);

            // Check if it's an AJAX request
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'qty' => $cart[$id]['qty'],
                ]);
            }

            if (isset($cart[$id]['slug'])) {
                return redirect()->route('frontend.product.details', $cart[$id]['slug']);
            }
        }

        if (request()->ajax()) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return redirect()->back()->with('error', 'Product not found in cart');
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
            session()->put('cart', $cart);

            // Check if it's an AJAX request
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'qty' => $cart[$id]['qty'],
                ]);
            }

            if (isset($cart[$id]['slug'])) {
                return redirect()->route('frontend.product.details', $cart[$id]['slug']);
            }
        }

        if (request()->ajax()) {
            return response()->json(['success' => false, 'message' => 'Cannot decrease quantity'], 400);
        }

        return redirect()->back()->with('error', 'Product not found in cart');
    }
}
