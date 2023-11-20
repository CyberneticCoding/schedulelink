<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    //Routes
    public function AccountView()
    {return Inertia::render('Settings/AccountSettingsPage');}
	public function Settings2()
	{return Inertia::render('Settings/Settings2');}
	public function CompanyView()
	{return Inertia::render('Settings/CompanyDetailsPage');}
	public function CompanyMembersView()
	{return Inertia::render('Settings/CompanyMembersPage');}
	public function CompanyAddMembersView()
	{return Inertia::render('Settings/CompanyAddMembersPage');}


}
