<?php

namespace App\Http\Controllers\BAckend\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        $cetagories = Category::select('id','title')->get();
        return view('backend.category.index', compact('cetagories') );
    }

    // category store
    public function categoryStore(Request $request){
        $cetagory = new Category();
        $cetagory->title = $request->title;
        $cetagory->slug=Str::slug($request->title) . uniqid();
        $cetagory->category_id = $request->category_id;
        $cetagory->meta_title=$request->meta_title;
        $cetagory->keywords=$request->keywords;
        $cetagory->description=$request->description;
        $cetagory->save();
        return redirect()->back();

    }

    // category view
    public function categoryView(){
        $cetagories = Category::with('parent')->get();
        return view('backend.category.categoryView', compact('cetagories'));
    }

    // category edit
    public function categoryEdit($slug){
        $category_edit = Category::where('slug', $slug)->first();
        $categories = Category::select('id','title')->get();
        return view('backend.category.editCategory', compact('category_edit', 'categories'));
    }

    // category update
    public function categoryUpdate(Request $request, $slug){
            $request->validate([
                'title'=>'required',
        ]);    
        $updateCategory = Category::where('slug', $slug)->first();
        $updateCategory->title = $request->title;
        $updateCategory->slug=Str::slug($request->title) . uniqid();
        $updateCategory->category_id = $request->category_id;
        $updateCategory->meta_title=$request->meta_title;
        $updateCategory->keywords=$request->keywords;
        $updateCategory->description=$request->description;
        $updateCategory->save();
        return redirect()->route('dashboard.category.category.view');
    }
    

}