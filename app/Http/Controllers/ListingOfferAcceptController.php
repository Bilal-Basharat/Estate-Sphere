<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class ListingOfferAcceptController extends Controller
{
    public function __invoke(Offer $offer){

        $listing = $offer->listing;

        //check if the lsiting is not sold first
        $this->authorize('update', $listing);

        //accept selected offer
        $offer->update([
            'accepted_at' => now()
        ]);

        $listing->sold_at = now();
        $listing->save();

        //reject other offers
        $listing->offers()->except($offer)->update([
            'rejected_at' => now()
        ]);

        return redirect()->back()->with([
            'success' => true,
            'message' => "Offer {$offer->id} accepted while others are rejected"
        ]);

    }
}
