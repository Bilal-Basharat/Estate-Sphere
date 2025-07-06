<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
        'price',
        'sold_at'
    ];

    protected $sortable = ['price', 'created_at'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeMostRecent($query)
    {
        return $query->orderByDesc('created_at');
    }
/** @param \Illuminate\Database\Eloquent\Builder $query */
    public function scopeFilter(Builder $query, array $filters):Builder 
    {
        return $query->when($filters['priceFrom'] ?? false, function ($query, $value) {
            $query->where('price', '>=', $value);
        })->when($filters['priceTo'] ?? false, function ($query, $value) {
            $query->where('price', '<=', $value);
        })->when($filters['beds'] ?? false, function ($query, $value) {
            $query->where('beds', $value < 6 ? '=' : '>=' ,  (int)$value);
        })->when($filters['baths'] ?? false, function ($query, $value) {
            $query->where('baths',$value < 6 ? '=' : '>=' , (int)$value);
        })->when($filters['areaFrom'] ?? false, function ($query, $value) {
            $query->where('area', '>=', $value);
        })->when($filters['areaTo'] ?? false, function ($query, $value) {
            $query->where('area', '<=', $value);
        })->when($filters['deleted'] ?? false, function ($query, $value) {
            $query->withTrashed();
        })->when($filters['by'] ?? false, function ($query, $value) {
            !in_array($value, $this->sortable) ? $query :
            $query->orderBy($value, $filters['order'] ?? 'desc');
        });
    }

    public function Images()
    {
        return $this->hasMany(ListingImage::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function scopeWithoutSold($query)
    {
        return $query->whereNull('sold_at');
    }
}
