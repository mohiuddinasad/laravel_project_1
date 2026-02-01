<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Images\ProductImage;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SweetAlert2\Laravel\Swal;

class ProductController extends Controller
{



    public function index()
    {
        $categories = Category::all();
        return view('backend.product.index', compact('categories'));
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',


        ]);

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->title = $request->title;
            $product->slug = Str::slug($request->title);
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->descriptions = $request->descriptions;
            $product->save();
            Swal::toastSuccess([
                'title' => 'Product Added Successfully',
                'timeout' => 1500,

            ]);


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('product_images/', $imageName, 'public');

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_name = $imageName;
                    $productImage->save();
                }
            }



            DB::commit();
            return back();
        } catch (\Exception $e) { 
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        $products = Product::with('category', 'productImage')->get();
        return view('backend.product.show', compact('products'));
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->with('productImage')->firstOrFail();
        $categories = Category::all();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->title = $request->title;
            $product->slug = Str::slug($request->title);
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->descriptions = $request->descriptions;
            $product->save();
            Swal::toastSuccess([
                'title' => 'Product Updated Successfully',
                'timeout' => 1500,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('product_images/', $imageName, 'public');

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_name = $imageName;
                    $productImage->save();
                }
            }

            DB::commit();
            return redirect()->route('dashboard.product.show');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function imageDelete($id)
    {
        $image = ProductImage::findOrFail($id);
        $image->delete();

        Swal::toastSuccess([
                'title' => 'Image Deleted Successfully',
                'timeout' => 1500,
            ]);
        return back();

    }

    public function deleteProduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $product->delete();

        Swal::toastSuccess([
                'title' => 'Product Deleted Successfully',
                'timeout' => 1500,
            ]);
        return back();
    }

}