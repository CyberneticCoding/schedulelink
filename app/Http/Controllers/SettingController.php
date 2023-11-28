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
    {return Inertia::render('Settings/AccountSettingsPage');}

	// ##Test
	public function Settings2()
	{return Inertia::render('Settings/Settings2');}

	// Company settings
	public function CompanyView()
	{return Inertia::render('Settings/CompanyDetailsPage');}

	// Company members
	public function CompanyMembersView(){
		if (Auth::check()) {
			// Haal de huidige ingelogde gebruiker op
			$currentUser = Auth::user();
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

		return Inertia::render('Settings/CompanyAddMembersPage', ['companySet' => '0']);
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
