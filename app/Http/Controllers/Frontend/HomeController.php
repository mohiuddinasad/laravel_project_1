<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Orders\Order;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('ProductImage')->get();
        // dd($products);
        return view('welcome', compact('products'));
    }


    public function addToCart($id)
    {
        $productCart = Product::with('ProductImage')->find($id);
        $cart = request()->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                "title" => $productCart->title,
                "price" => $productCart->price,
                "discount_price" => $productCart->discount_price,
                "qty" => 1,
                "image" => $productCart->ProductImage[0]->image_name ?? null,
                "descriptions" => $productCart->descriptions,
            ];
        }

        request()->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeCart($id)
    {
        $cart = request()->session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            request()->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product cart unset!');
        }
    }

    public function checkout()
    {
        return view('frontend.checkout');
        ;
    }

    public function orderStore(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company_name' => 'nullable|string|max:255',
                'address' => 'required|string',
                'country' => 'required|string',
                'state' => 'required|string',
                'zip_code' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'total' => 'required|numeric',
                'payment_method' => 'required|string',
                'order_notes' => 'nullable|string',
            ]);

            // Create the order
            $order = new Order();
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->company_name = $request->company_name;
            $order->address = $request->address;
            $order->country = $request->country;
            $order->state = $request->state;
            $order->zip_code = $request->zip_code;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->total = $request->total;
            $order->payment_method = $request->payment_method;
            $order->status = 'pending';
            $order->order_notes = $request->order_notes;

            // Save and check if successful
            if ($order->save()) {
                // Clear the cart after placing the order
                $request->session()->forget('cart');

                return redirect()->route('frontend.checkout')->with('success', 'Order placed successfully!');
            } else {
                return back()->with('error', 'Failed to place order. Please try again.');
            }

        } catch (\Exception $e) {
            // Log the error
            Log::error('Order creation failed: ' . $e->getMessage());

            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}