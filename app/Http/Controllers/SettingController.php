<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SettingController extends Controller
{
    // Account settings
    public function accountPage()
	{
		return Inertia::render('Settings/AccountPage');
	}
	// Notifications settings
	public function notificationsPage()
	{
		return Inertia::render('Settings/NotificationsPage');
	}
	// Company settings
	public function companyDetailsPage(){
		return Inertia::render('Settings/Company/DetailsPage');
	}
	// Company members
	public function companyMembersPage()
	{
		$activeCompany = auth()->user()->activeCompany;
		if ($activeCompany) {
			$companyMembers = $activeCompany->users;
			return Inertia::render('Settings/Company/MembersPage', ['companyMembers' => $companyMembers]);
		} else {
			return response()->json(['message' => 'User does not have an active company.']);
		}
	}

	// Add company members
	public function companyMembersAddPage(){
		return Inertia::render('Settings/Company/MemberAddPage');
	}
	public function RemoveUserFromCompany(Request $request){
		//dd($request->input('userId'));
		$userId = $request->input('userId');
		$companyId = $request->input('companyId');
		// Verwijder de gebruiker uit het bedrijf
		DB::table('company_users')->where('company_id', $companyId)->where('user_id', $userId)->delete();


		return response()->json(['success' => true]);
	}


}
