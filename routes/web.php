<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\ListingOfferAcceptController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show']);


Route::resource('listing', ListingController::class)
->only(['index', 'show']);


Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store']);
Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);

Route::prefix('realtor')
->name('realtor.')
->middleware('auth')
->group(function () {
    Route::name('listing.restore')->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->withTrashed();
    Route::resource('listing', RealtorListingController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy'])->withTrashed();

    Route::name('offer.accept')->put('offer/{offer}/accept', ListingOfferAcceptController::class);
    
    Route::resource('listing.image', ListingImageController::class)
    ->only(['create', 'store', 'destroy']);
});

Route::resource('listing.offer', ListingOfferController::class)
->middleware('auth')
->only(['store']);
