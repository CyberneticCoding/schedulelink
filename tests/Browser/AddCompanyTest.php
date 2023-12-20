<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddCompanyTest extends DuskTestCase
{
	use DatabaseMigrations;
    public function test_user_can_create_company(): void
    {
		$user = $this->setupTestuser();
		$this->browse(function (Browser $browser) use ($user) {
			$browser->loginAs($user)
				->visit('/settings/company/add')
				->type('name', 'Test')
				->type('description', 'Case')
				->press('Create')
				->waitForLocation('/settings/company')
				->assertPathIs('/settings/company');
		});
    }
	public function test_user_can_not_create_company(): void
	{
		$user = $this->setupTestuser();
		$this->browse(function (Browser $browser) use ($user) {
			$browser->loginAs($user)
				->visit('/settings/company/add')
				->type('name', 'T') //company name too short
				->type('description', 'Case')
				->press('Create')
				->pause(1000)
				->assertPathIs('/settings/company/add');
		});
	}
	public function setupTestuser(){
		return User::factory()->create([
			'first_name' => 'Tester',
			'last_name' => 'ScheduleLink',
			'email' => 'Tester@schedulelink.com',
			'password' => Hash::make('test'),
		]);
	}
}
