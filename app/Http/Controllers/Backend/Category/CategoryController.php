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
        $cetagory->meta_title=$request->meta_title;
        $cetagory->keywords=$request->keywords;
        $cetagory->description=$request->description;
        $cetagory->save();
        return redirect()->back();
        
    }

    // category view
    public function categoryView(){
        $cetagories = Category::get(); 
        return view('backend.category.categoryView', compact('cetagories'));
    }

}