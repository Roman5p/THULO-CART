<?php

namespace App\Http\Controllers\Backend;  // Defines the namespace for backend controllers

use App\Http\Controllers\Controller;  // Imports base Controller class
use App\Models\Category;              // Imports Category model
use Illuminate\Http\Request;          // Imports Request class for HTTP handling

class CategoryController extends Controller  // CategoryController class extending base Controller
{
    /**
     * Displays all product categories in the admin panel
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();  // Retrieve all categories from database
        return view('backend.products.product-category', compact('categories'));  // Return view with categories data
    }

    /**
     * Creates a new product category
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required',                    // Category name is mandatory
            'image' => 'required|image|max:4096',    // Image is required, must be an image, max 4MB
        ]);

        $category = new Category();  // Create new Category instance
        $category->name = $request->name;  // Set category name from request
        // Store uploaded image in 'public' disk under 'categories' directory
        $category->image = $request->file('image')->store('categories', 'public');
        $category->save();  // Save category to database

        // Redirect to category index with success message
        return redirect()->route('admin.product-category.index')->with('success', 'Category created successfully');
    }

    /**
     * Updates an existing product category
     * @param \Illuminate\Http\Request $request
     * @param int $id Category ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data (only name is required)
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);  // Find category by ID
        // Check if category exists
        if (!$category) {
            return redirect()->route('admin.product-category.index')->with('error', 'Category not found');
        }

        $category->name = $request->name;  // Update category name
        // Check if new image is uploaded
        if ($request->hasFile('image')) {
            // Store new image, overwriting old one (Note: old image isn't deleted)
            $category->image = $request->file('image')->store('categories', 'public');
        }
        $category->save();  // Save updated category

        // Redirect to category index with success message
        return redirect()->route('admin.product-category.index')->with('success', 'Category Updated successfully');
    }

    /**
     * Deletes a product category
     * @param int $id Category ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = Category::find($id);  // Find category by ID (Note: should use findOrFail)
        $category->delete();  // Delete category from database (Note: doesn't delete associated image)

        // Redirect to category index with success message
        // Note: Second parameter should be part of with() method
        return redirect()->route('admin.product-category.index', 'Category Deleted successfully');
    }
}