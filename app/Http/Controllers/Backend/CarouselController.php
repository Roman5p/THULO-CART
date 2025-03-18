<?php

namespace App\Http\Controllers\Backend;  // Defines the namespace for backend controllers

use App\Http\Controllers\Controller;  // Imports base Controller class
use App\Models\Carousel;              // Imports Carousel model
use Illuminate\Http\Request;          // Imports Request class for HTTP handling
use Storage;                          // Imports Storage facade for file operations

class CarouselController extends Controller  // CarouselController class extending base Controller
{
    /**
     * Displays all carousel images in the admin panel
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $carousels = Carousel::all();  // Retrieve all carousel records from database
        return view('backend.carousels.index', compact('carousels'));  // Return view with carousel data
    }

    /**
     * Stores a new carousel image
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',  // Must be image, specific types, max 4MB
        ]);

        $carousel = new Carousel();  // Create new Carousel instance
        // Store image in 'public' disk under 'carousel' directory and get path
        $imagepath = $request->file('image')->store('carousel', 'public');
        $carousel->image = $request->image->store('carousel');  // Note: This line seems redundant with next line
        $carousel->save();  // Save carousel record to database

        // Redirect to carousel index with success message
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel Image Added Successfully');
    }

    /**
     * Updates an existing carousel image
     * @param \Illuminate\Http\Request $request
     * @param int $id Carousel ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $carousel = Carousel::find($id);  // Find carousel by ID (Note: should add findOrFail for safety)

        // Validate the uploaded image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',  // Same validation as store
        ]);

        // Check if new image is provided
        if ($request->has('image')) {
            // Delete old image if it exists
            if ($carousel->image) {
                Storage::disk('public')->delete($carousel->image);  // Remove old image from storage
            }
            // Store new image and update path
            $imagepath = $request->file('image')->store('carousel', 'public');
            $carousel->image = $imagepath;  // Update image path in model
            $carousel->save();  // Save updated record
        }

        // Redirect to carousel index with success message
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel Image Updated Successfully');
    }

    /**
     * Deletes a carousel image
     * @param int $id Carousel ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $carousel = Carousel::find($id);  // Find carousel by ID (Note: should add findOrFail)

        // Delete associated image file if it exists
        if ($carousel->image) {
            Storage::disk('public')->delete($carousel->image);  // Remove image from storage
        }
        $carousel->delete();  // Delete carousel record from database

        // Redirect to carousel index with success message
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel Image Deleted Successfully');
    }
}