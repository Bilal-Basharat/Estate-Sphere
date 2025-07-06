<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    protected $fillable = ['amount', 'accepted_at', 'rejected_at'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function bidder(){
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function ScopeByMe($query) {
        return $query->where('bidder_id', Auth::user()?->id);
    }

    public function scopeExcept($query, $offer){
        return $query->where('id', '!=', $offer->id);
    }
}
