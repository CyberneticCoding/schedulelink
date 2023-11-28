<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
	use DatabaseMigrations;
    public function test_user_can_register(): void
    {
		$this->browse(function (Browser $browser) {
			$browser->visit('/register')
				->type('firstname', 'Test')
				->type('lastname', 'Case')
				->type('email', 'email@email.com')
				->type('password', 'password')
				->type('password2','password')
				->press('Register')
				->waitForLocation('/login')
				->assertPathIs('/login');
		});
    }
	public function test_user_can_not_register(): void
	{
		$this->browse(function (Browser $browser) {
			$browser->visit('/register')
				->type('firstname', 'Test')
				->type('lastname', 'Case')
				->type('email', 'email@email.com')
				->type('password', 'password')
				->type('password2','wrongpassword')
				->press('Register')
				->waitForLocation('/register')
				->assertPathIs('/register');
		});
	}
}
