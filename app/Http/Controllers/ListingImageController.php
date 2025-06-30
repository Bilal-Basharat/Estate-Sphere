<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;

class ListingImageController extends Controller
{
    public function create(Listing $listing){

        $listing->load('images');

        return inertia('Realtor/ListingImages/Create',
    [
        'listing' => $listing
    ]);
    }

    public function store(Listing $listing, Request $request){

        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        foreach($request->file('images') as $image){
            $path = $image->store('images','public');
        }

        $listing->images()->save(new ListingImage([
            'filename' => $path
        ]));

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Images uploaded successfully'
        ]);
    }

    public function destroy(Listing $listing, ListingImage $image){
     
        $image->delete();

        return redirect()->back()->with([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
