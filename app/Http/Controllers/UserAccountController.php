<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create($validated);

        Auth::login($user);

        //sending the email verification
        event(new Registered($user));

        return redirect()->route('listing.index')->with([
            'success' => true,
            'message' => 'Account created successfully'
        ]);
    }
}
