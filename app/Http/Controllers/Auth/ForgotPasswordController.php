<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function create(){
        return inertia('Auth/ForgotPassword');
    }

    public function store(Request $request){
        
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? redirect()->route('login')->with(['message' => 'Reset password link sent! Check your mail'])
            : back()->withErrors(['email' => __($status)]);
}

}