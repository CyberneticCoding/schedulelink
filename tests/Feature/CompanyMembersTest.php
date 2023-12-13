<?php


use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class CompanyMembersTest extends TestCase
{
	public function test_company_owner_can_remove_users()
	{	//setup test users and company
		$owner = User::factory()->create();
		$company = $this->setupTestcompany($owner);
		$members = User::factory()->count(10)->create();
		$company->users()->attach($members);
		Auth::guard()->setUser($owner);
		// check if user exists in DB
		$this->assertDatabaseHas('company_user', ['user_id' => $members[5]->id, 'company_id' => $company->id]);
		// remove user as owner
		$response = $this->post('/settings/company/members/remove', [
			'userId'=> $members[5]->id,
			'companyId'=> $company->id
		]);
		// check response
		$response->assertStatus(302);
		// check if user is removed from DB
		$this->assertDatabaseMissing('company_user', ['user_id' => $members[5]->id, 'company_id' => $company->id]);

	}

	public function test_user_cannot_remove_users_from_active_company()
	{	//setup test users and company
		$owner = User::factory()->create();
		$company = $this->setupTestcompany($owner);
		$members = User::factory()->count(10)->create();
		$company->users()->attach($members);
		Auth::guard()->setUser($members[0]);
		// check if user exists in DB
		$this->assertDatabaseHas('company_user', ['user_id' => $members[6]->id, 'company_id' => $company->id]);
		// remove user as a member
		$response = $this->post('/settings/company/members/remove', [
			'userId'=> $members[6]->id,
			'companyId'=> $company->id
		]);
		// check response
		$response->assertStatus(302);
		// check if user is NOT removed from DB
		$this->assertDatabaseHas('company_user', ['user_id' => $members[6]->id, 'company_id' => $company->id]);
	}
	public function setupTestcompany($user){
		$company = Company::create([
			'name' => 'TestCompany',
			'owner_id' => $user->id,
		]);
		// set given user as owner
		$user->update(['active_company_id' => $company->id]);
		return $company;
	}
}
