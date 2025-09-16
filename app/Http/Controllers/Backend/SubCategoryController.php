<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function subCategoryCreate ()
    {
        $categories = Category::all();
        return view('backend.subcategory.create', compact('categories'));
    }

    public function subCategoryStore (Request $request)
    {
        $subCategory = new SubCategory();

        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->cat_id = $request->cat_id;

        $subCategory->save();
        return redirect()->back();
    }

    public function subCategoryList ()
    {
        $subCategories = SubCategory::with('category')->get();
        return view('backend.subcategory.list', compact('subCategories'));
    }

    public function subCategoryDelete ($id)
    {
        $subCategory = SubCategory::find($id);
        
        $subCategory->delete();
        return redirect()->back();
    }

    public function subCategoryEdit ($id)
    {
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        return view('backend.subcategory.edit', compact('subCategory', 'categories'));
    }

    public function subCategoryUpdate (Request $request, $id)
    {
        $subCategory = SubCategory::find($id);

        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->cat_id = $request->cat_id;

        $subCategory->save();
        return redirect('admin/sub-category/list');
    }
}
