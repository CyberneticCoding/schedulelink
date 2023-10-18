<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function index (Request $request) {
        return Inertia::render('RegistrationPage');
    }

    public function register(RegistrationRequest $request)
    {
		$validated = $request->validated();


		$newuser = new User();
		$newuser->first_name = $validated['firstname'];
		$newuser->last_name = $validated['lastname'];
		$newuser->tutorial_done = false;
		$newuser->email = $validated['email'];
		$newuser->password = $validated['password'];
		$newuser->save();

		return redirect('/');

    }
}
