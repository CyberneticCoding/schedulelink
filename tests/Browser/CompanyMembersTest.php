<?php

namespace Tests\Browser;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CompanyMembersTest extends DuskTestCase
{
	use DatabaseMigrations;

    public function test_company_owner_can_remove_member(): void
    {
		$user = $this->setupTestUser();
		$company = $this->setupTestCompany($user);

		$users = User::factory()->count(10)->create();
		$toRemoveUser = User::factory()->create([
				'first_name' => 'Remove',
				'last_name' => 'Test',
			]);

		$company->users()->attach($users);
		$company->users()->attach($toRemoveUser);
		$this->browse(function (Browser $browser) use ($user, $toRemoveUser) {
			$browser->loginAs($user);
			$browser->visit('/settings/company/members');
			$browser->waitForText('Company');
			$browser->assertSee('Remove Test');
			$this->assertDatabaseHas('company_user', ['user_id' => $toRemoveUser->id]);
			$this->findRemoveButton($browser, $toRemoveUser);
			$this->assertDatabaseMissing('company_user', ['user_id' => $toRemoveUser->id]);
        });
	}
	public function test_company_owner_can_see_company_users(): void
	{
		$user = $this->setupTestUser();
		$company = $this->setupTestCompany($user);

		$users = User::factory()->count(10)->create();
		$company->users()->attach($users);

		$this->browse(function (Browser $browser) use ($user, $users) {
			$browser->loginAs($user);
			$browser->visit('/settings/company/members');
			$browser->waitForText('Company');
			$browser->assertSee($users[2]->first_name." ".$users[2]->last_name);
		});
	}

	public function findRemoveButton($browser, $user){

		$browser->with('.user-list', function (Browser $browser) use ($user) {
			$name = $user->first_name." ".$user->last_name;
			$browser->assertSee($name)
				->click('#remove-'.$user->id);
			$browser->pause(1000);
			$browser->assertMissing($name);
		});
	}
	public function setupTestUser(){
		return User::factory()->create([
			'first_name' => 'Tester',
			'last_name' => 'ScheduleLink',
			'email' => 'Tester@schedulelink.com',
			'password' => Hash::make('test'),
		]);
	}
	public function setupTestCompany($user){
		$company = Company::create([
			'name' => 'TestCompany',
			'owner_id' => $user->id,
		]);
		$user->update(['active_company_id' => $company->id]);
		return $company;
	}
}