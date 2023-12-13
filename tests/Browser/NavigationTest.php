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
			$browser->visit('/calendar');
			$this->clickNav($browser, '/combined-calendar', 'Combined Calendar');
			$this->checkDefaultNav($browser);

			$this->clickNav($browser, '/meetings', 'Meetings');
			$this->checkDefaultNav($browser);

			$this->clickNav($browser, '/teams', 'Teams');
			$this->checkDefaultNav($browser);

			$this->clickNav($browser, '/calendar', 'Calendar');
			$this->checkDefaultNav($browser);

			$browser->click('#availability-button')
			->waitForText('Save Changes');
			$browser->assertSee('Save Changes');
			$browser->assertSee('Cancel');
			$this->checkDefaultNav($browser);

			//settings navigation
			$browser->clickLink('Settings');

			$this->clickNav($browser, '/settings/notifications', 'Notifications');
			$this->checkSettingsNav($browser);

			$this->clickNav($browser, '/settings/account', 'Account');
			$this->checkSettingsNav($browser);
        });
    }

	public function clickNav($browser, $url, $button) {
		$browser->waitForText($button)
			->clickLink($button)
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