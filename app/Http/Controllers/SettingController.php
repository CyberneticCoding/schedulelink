<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function accountPage()
    {
		return Inertia::render('Settings/AccountPage');
    }
	public function notificationsPage()
	{
		return Inertia::render('Settings/NotificationsPage');
	}

}
