<?php


use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;
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

		// remove user as owner
		$response = $this->post('/settings/company/members/remove', [
			'userId'=> $members[5]->id,
			'companyId'=> $company->id
		]);
		// check response = succes
		$response->assertStatus(200);
		// check if user is removed from DB
		$this->assertDatabaseMissing('users', ['id' => $members[5]->id]);

	}

	public function test_user_cannot_remove_users_from_active_company()
	{	//setup test users and company
		$owner = User::factory()->create();
		$company = $this->setupTestcompany($owner);
		$members = User::factory()->count(10)->create();
		$company->users()->attach($members);
		Auth::guard()->setUser($members[0]);

		// remove user as a member
		$response = $this->post('/settings/company/members/remove', [
			'userId'=> $members[6]->id,
			'companyId'=> $company->id
		]);
		// check response = error
		$response->assertStatus(500);
		// check if user is NOT removed from DB
		$this->assertDatabaseHas('users', ['id' => $members[5]->id]);
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
