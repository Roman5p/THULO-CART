<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('backend.products.product-category', compact('categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|max:4096',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->image = $request->file('image')->store('categories', 'public');
        $category->save();

        return redirect()->route('admin.product-category.index')->with('success', 'Category created successfully');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.product-category.index')->with('error', 'Category not found');
        }

        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('categories', 'public');
        }
        $category->save();

        return redirect()->route('admin.product-category.index')->with('success', 'Category Updated successfully');
    }



    public function delete($id)
    {

        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.product-category.index', 'Category Deleted successfully');

    }
}
