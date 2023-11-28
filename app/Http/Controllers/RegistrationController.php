<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function index() {
        return Inertia::render('RegistrationPage');
    }

    public function register(RegistrationRequest $request)
    {
		$validated = $request->validated();

		User::create([
			'first_name' => $validated['firstname'],
			'last_name' => $validated['lastname'],
			'tutorial_done' => false,
			'email' => $validated['email'],
			'password' => $validated['password'],
		]);

		return redirect('/');
    }
}
