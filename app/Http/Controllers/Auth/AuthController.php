<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException as ValidationException;

class AuthController extends Controller
{
    public function create(){
        return inertia('Auth/Login');
    }
    public function store(Request $request){
    
        //validating and verifying the credentials
        if(!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]))){
            throw ValidationException::withMessages([
                'email' => 'Authentication Failed'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('listing');

    }
    public function destroy(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('listing.index');

    }
}
