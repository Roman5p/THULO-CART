<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $products = Product::with('category')->get();
        return view('backend.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:4096',
            'description' => 'nullable|string',
            'is_feature' => 'sometimes|boolean',
            'is_selling' => 'sometimes|boolean',
            'is_popular' => 'sometimes|boolean',
            'is_new' => 'sometimes|boolean',
        ]);

        // Generate a unique slug for the product
        $slug = Str::slug($request->name);
        while(Product::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->name) . rand(1, 100);
        }

        // Store the product image
        $imagePath = $request->file('image')->store('products', 'public');

        // Create a new product instance and save it to the database
        $product = new Product();
        $product->slug = $slug;
        $amount = $request->discount_amount;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        if (!$request->discount_amount) {
            $amount = 0;
        }
        $product->discount_amount = $amount;
        $product->category_id = $request->category_id;
        $product->image = $imagePath;
        $product->description = $request->description;
        $product->is_feature = $request->is_feature;
        $product->is_selling = $request->is_selling;
        $product->is_popular = $request->is_popular;
        $product->is_new = $request->is_new;
        $product->actual_amount = $request->price - $amount;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', "Product created successfully");
    }

    // Show the form for editing the specified product
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('backend.products.edit', compact('categories', 'product'));
    }

    // Update the specified product in storage
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
            'is_feature' => 'sometimes|boolean',
            'is_selling' => 'sometimes|boolean',
            'is_popular' => 'sometimes|boolean',
            'is_new' => 'sometimes|boolean',
        ]);

        // Update the product image if a new one is uploaded
        if ($request->has('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update the product details
        $amount = $request->discount_amount;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        if (!$request->discount_amount) {
            $amount = 0;
        }
        $product->discount_amount = $amount;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->is_feature = $request->is_feature;
        $product->is_selling = $request->is_selling;
        $product->is_popular = $request->is_popular;
        $product->is_new = $request->is_new;
        $product->actual_amount = $request->price - $amount;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', "Product updated successfully");
    }

    // Remove the specified product from storage
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully!');
    }
}
