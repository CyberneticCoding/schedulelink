<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function index (Request $request) {
        return Inertia::render('RegistrationPage');
    }
    public function register(Request $request)
    {
		$newuser = new User();
		//$newuser->first_name = $request->first_name;
		//$newuser->last_name = $request->last_name;
		$newuser->first_name = "jan";
		$newuser->last_name = "jans";
		$newuser->tutorial_done = false;
		$newuser->email = $request->email;
		$newuser->password = $request->password;
		$newuser->save();

		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->route('calendar');
		}


		return back()->withErrors([
			'email' => 'The provided credentials do not match our records.',
		])->onlyInput('email');
    }
}
