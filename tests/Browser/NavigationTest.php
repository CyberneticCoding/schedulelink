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
			$this->visitUrl($browser, '/combined-calendar');
			$this->checkDefaultNav($browser);

			$this->visitUrl($browser, '/meetings');
			$this->checkDefaultNav($browser);

			$this->visitUrl($browser, '/teams');
			$this->checkDefaultNav($browser);

			$this->visitUrl($browser, '/calendar');
			$this->checkDefaultNav($browser);

			$browser->click('#availability-button')
			->waitForText('Save Changes');
			$browser->assertSee('Save Changes');
			$browser->assertSee('Cancel');
			$this->checkDefaultNav($browser);

			//settings navigation
			$this->visitUrl($browser, '/settings/account');
			$this->checkSettingsNav($browser);

			$this->visitUrl($browser, '/settings/notifications');
			$this->checkSettingsNav($browser);

        });
    }

	public function visitUrl($browser, $url) {
		$browser->visit($url)
			->waitForLocation($url)
			->assertPathIs($url);
	}
	public function checkDefaultNav($browser) {
		$browser->assertSee('Calendar');
		$browser->assertSee('Combined Calendar');
		$browser->assertSee('Meetings');
		$browser->assertSee('Teams');
		$browser->assertSee('Settings');
	}
	public function checkSettingsNav($browser) {
		$browser->assertSee('Account');
		$browser->assertSee('Notifications');
		$browser->assertSee('User Settings');
		$browser->assertSee('Company Settings');
		$browser->assertSee('Back');
	}
}