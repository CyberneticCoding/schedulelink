<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function Laravel\Prompts\error;

class SettingController extends Controller
{
    // Account settings
    public function AccountView()
	{
		if (Auth::check()) {
			//		als current company is opgeslagen in de user:
			if (!is_null(auth()->user()->current_company)) {
				return Inertia::render('Settings/AccountSettingsPage', ['companySet' => true]);
			}
		}
		return Inertia::render('Settings/AccountSettingsPage', ['companySet' => false]);
	}
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
	// ##Test
	public function Settings2()
	{return Inertia::render('Settings/Settings2');}

	// Company settings
	public function CompanyView(){
		if (Auth::check()) {
			//		als current company is opgeslagen in de user:
			if (!is_null(auth()->user()->current_company)) {
				return Inertia::render('Settings/CompanyDetailsPage', [ 'companySet' => true]);}
		}
		return Inertia::render('Settings/CompanyDetailsPage', ['companySet' => false]);
	}

	// Company members
	public function CompanyMembersView(){
		if (Auth::check()) {
			//		als current company is opgeslagen in de user:
			if (!is_null(auth()->user()->current_company)) {
				$currentCompany = DB::table('companies')
					->where('companies.id', '=', auth()->user()->current_company)
					->join('users', 'companies.owner_id', '=', 'users.id')
					->select('users.first_name', 'users.last_name', 'companies.*')
					->get();
				$currentCompanyMembers = DB::table('company_users')
					->where('company_id','=', auth()->user()->current_company)
					->join('users', 'company_users.user_id', '=', 'users.id')
					->select('users.first_name', 'users.last_name', 'company_users.*')
					->get();

				// Doe iets met de $currentUser, bijvoorbeeld teruggeven aan de view
				return Inertia::render('Settings/CompanyMembersPage', [ 'companySet' => true,'currentCompany' => $currentCompany, 'currentCompanyMembers' => $currentCompanyMembers]);}
		}
		return Inertia::render('Settings/CompanyMembersPage', ['companySet' => false]);
	}

	// Add company members
	public function CompanyAddMembersView(){
		if (Auth::check()) {
			//		als current company is opgeslagen in de user:
			if (!is_null(auth()->user()->current_company)) {
				return Inertia::render('Settings/CompanyAddMembersPage', [ 'companySet' => true]);}
		}
		return Inertia::render('Settings/CompanyAddMembersPage', ['companySet' => false]);
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
