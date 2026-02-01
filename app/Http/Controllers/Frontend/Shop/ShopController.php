<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop()
    {
        $categories = Category::whereNull('category_id')
            ->with('children')
            ->get();
        $products = Product::with('ProductImage')->get();

        return view('frontend.shop', compact('categories', 'products'));
    }

    public function categoryWiseProduct($slug)
    {
        $categories = Category::whereNull('category_id')
            ->with('children')
            ->get();

        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->with('ProductImage')
            ->get();

        return view('frontend.shop', compact('categories', 'products', 'category'));
    }

    public function filter(Request $request)
    {
        $query = Product::with('productImage');

        // Filter by category (including all subcategories)
        if ($request->filled('category')) {
            $categoryId = $request->category;

            // Get all category IDs (parent + all children recursively)
            $categoryIds = $this->getCategoryAndChildrenIds($categoryId);

            // Filter products by these category IDs
            $query->whereIn('category_id', $categoryIds);
        }

        // Filter by price range
        if ($request->filled('price')) {
            $priceRange = $request->price;

            if ($priceRange === '0-50') {
                $query->whereBetween('price', [0, 50]);
            } elseif ($priceRange === '50-100') {
                $query->whereBetween('price', [50, 100]);
            } elseif ($priceRange === '100-200') {
                $query->whereBetween('price', [100, 200]);
            } elseif ($priceRange === '200+') {
                $query->where('price', '>=', 200);
            }
        }

        // Sort products
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('title', 'desc');
                    break;
                default: // latest
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Get products
        $products = $query->get();

        // Return HTML for AJAX request
        if ($request->ajax()) {
            $html = view('frontend.partials.product-list', compact('products'))->render();

            return response()->json([
                'html' => $html,
                'count' => $products->count(),
            ]);
        }

        // If not AJAX, return full view
        $categories = Category::whereNull('category_id')->with('children')->get();

        return view('frontend.shop', compact('categories', 'products'));
    }

    /**
     * Get category ID and all its children IDs recursively
     * Note: Using 'category_id' as the foreign key (not 'parent_id')
     */
    private function getCategoryAndChildrenIds($categoryId)
    {
        // Start with the parent category ID
        $ids = [$categoryId];

        // Get all direct children (where category_id = $categoryId)
        $children = Category::where('category_id', $categoryId)->get();

        // For each child, recursively get their children too
        foreach ($children as $child) {
            $ids = array_merge($ids, $this->getCategoryAndChildrenIds($child->id));
        }

        return $ids;
    }
}
