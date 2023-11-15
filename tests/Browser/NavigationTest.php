<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NavigationTest extends DuskTestCase
{
	use DatabaseMigrations;

	protected $user;
    /**
     * A Dusk test example.
     */
    public function test_user_can_navigate_through_application(): void
    {
		$this->user = User::factory()->create([
			'email' => 'tester@schedulelink.com',
		]);
        $this->browse(function (Browser $browser) {
			$browser->loginAs($this->user);
			$browser->visit('/combined-calendar')
				->waitForLocation('/combined-calendar')
				->assertPathIs('/combined-calendar');
            $browser->visit('/meetings')
				->waitForLocation('/meetings')
				->assertPathIs('/meetings');
			$browser->visit('/teams')
				->waitForLocation('/teams')
				->assertPathIs('/teams');
        });
    }
}
