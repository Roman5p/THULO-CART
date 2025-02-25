<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('backend.carousels.index', compact('carousels'));
    }

    public function store(request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $carousel = new Carousel();
        $imagepath = $request->file('image')->store('carousel', 'public');
        $carousel->image = $request->image->store('carousel');
        $carousel->save();

        return redirect()->route(route: 'admin.carousel.index')->with('success', 'Carousel Image Added Successfully');

    }

    public function update(Request $request, $id)
    {

        $carousel = Carousel::find($id);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->has('image')) {
            if ($carousel->image) {
                Storage::disk('public')->delete($carousel->image);
            }
            $imagepath = $request->file('image')->store('carousel', 'public');

            $carousel->image = $imagepath;
            $carousel->save();
        }

        return redirect()->route(route: 'admin.carousel.index')->with('success', 'Carousel Image Updated Successfully');

    }

    public function delete($id)
    {
        $carousel = Carousel::find($id);
        if ($carousel->image) {
            Storage::disk('public')->delete($carousel->image);
        }
        $carousel->delete();

        return redirect()->route(route: 'admin.carousel.index')->with('success', 'Carousel Image Deleted Successfully');
    }
}
