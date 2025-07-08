<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\ListingOfferAcceptController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificiationMarkController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show']);


//routes for diapling listing
Route::resource('listing', ListingController::class)
->only(['index', 'show']);


//routes for login logout
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store']);
Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

//route for registering user account
Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);

//route for account email verification notice
Route::get('email/verify', function() {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

//route for sending email verification
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('listing.index')->with([
        'success' => true,
        'message' => 'Account verified successfully'
    ]);
})->middleware(['auth', 'signed'])->name('verification.verify');

//route for resending the email verification notification
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//routes for the listing CRUD belonging to the author and showing the offers belonging to one of the listings
Route::prefix('realtor')
->name('realtor.')
->middleware(['auth', 'verified'])
->group(function () {
    Route::name('listing.restore')->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->withTrashed();
    Route::resource('listing', RealtorListingController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy'])->withTrashed();

    Route::name('offer.accept')->put('offer/{offer}/accept', ListingOfferAcceptController::class);
    
    Route::resource('listing.image', ListingImageController::class)
    ->only(['create', 'store', 'destroy']);
});

//route for making offer to a listing
Route::resource('listing.offer', ListingOfferController::class)
->middleware('auth')
->only(['store']);

//route for showing offer notification for a listing
Route::resource('notification', NotificationController::class)
->middleware('auth')
->only(['index']);

//route for marking notification as read
Route::put('notification/{notification}/mark', NotificiationMarkController::class)
->middleware('auth')
->name('notification.mark');

// //forgot password routes
// Route::resource('/forgot-password', ForgotPasswordController::class)
// ->middleware('guest')
// ->only(['create', 'store']);

// //reset password routes
// Route::resource('/reset-password', ResetPasswordController::class)
// ->middleware('guest')
// ->only(['create', 'store'])
// ->parameters([
//     'reset-password' => 'token'
// ]);

// Password reset routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request'); // This name is expected by Laravel

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email'); // Expected name for sending reset link

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset'); // This is the missing route

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');
    
// Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');