<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AccountView()
    {
		return Inertia::render('Settings/AccountSettingsPage');
    }
	public function CompanyView()
	{
		return Inertia::render('Settings/CompanyDetailsPage');
	}

}
