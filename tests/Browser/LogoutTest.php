<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
{
	use DatabaseMigrations;
    public function test_user_can_log_out_via_frontend_menu(): void
    {
		$this->user = User::factory()->create([
			'email' => 'tester@schedulelink.com',
		]);
		$this->browse(function (Browser $browser) {
			$browser->loginAs($this->user);
			$browser->visit('/calendar')
				->waitForLocation('/calendar');
			$browser->click('#user-profile-button')
				->pause(1000);
			$browser->click('.logout-button')
				->waitForLocation('/login')
				->assertPathIs('/login');

			//$browser->logout();
		});
    }
}
