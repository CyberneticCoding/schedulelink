<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function index (Request $request) {
        return Inertia::render('RegistrationPage');
    }
//    public function register(Request $request)
//    {
//        $credentials = $request->validate([
//            'email' => ['required', 'email'],
//            'password' => ['required'],
//        ]);
//
//        if (Auth::attempt($credentials)) {
//            $request->session()->regenerate();
//            return redirect()->route('calendar');
//        }
//
//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ])->onlyInput('email');
//    }
}
