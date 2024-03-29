<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\AddCompanyRequest;

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
		return Inertia::render('Settings/CompanyPage');
	}
	// Company add
	public function companyAddPage(){
		return Inertia::render('Settings/Company/CompanyAddPage');
	}
	public function addCompany(AddCompanyRequest $request)
	{
		$validated = $request->validated();

		$newcompany = new Company();
		$newcompany->name = $validated['name'];
		$newcompany->description = $validated['description'];
		$newcompany->owner_id = auth()->user()->id;
		$newcompany->save();

		if($request['default']||auth()->user()->active_company_id===null){
			$user = auth()->user();
			$user->active_company_id = $newcompany->id;
			$user->save();
		}


		return redirect('/settings/company');
	}
	// Company members
	public function companyMembersPage()
	{
		$activeCompany = auth()->user()->activeCompany;
		if ($activeCompany) {
			$companyMembers = $activeCompany->users;
			return Inertia::render('Settings/Company/MembersPage', ['companyMembers' => $companyMembers]);
		} else {
			return response()->json(['message' => 'User does not have an active company.']); //todo redirect to settings page instead
		}
	}
	// Add company members
	public function companyMembersAddPage(){
		return Inertia::render('Settings/Company/MemberAddPage');
	}
	public function companyMembersRemove(Request $request){
		$userId = $request->userId;
		$companyId = $request->companyId;

		$user = User::findOrFail($userId);
		$company = Company::findOrFail($companyId);

		$company->users()->detach($user);
		return redirect()->route('companies.members');
	}


}
