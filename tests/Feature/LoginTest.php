<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class LoginTest extends TestCase
{
	use WithFaker, RefreshDatabase;

	/**
	 * Test if the user can see the login page
	 *
	 * @return void
	 */
	public function test_user_can_see_login_page()
	{
		$response = $this->get('/login');
		$response->assertStatus(200);
		$response->assertInertia(fn (AssertableInertia $page) => $page
			->component('LoginPage')
		);
	}

	///**
	// * Test if the user cannot login if he is already logged in. Todo
	// *
	// * @return void
	// */
	//public function test_user_cannot_see_login_page_when_authenticated()
	//{
	//	$user = User::factory()->create();
	//
	//	$response = $this->actingAs($user)->get('/login');
	//
	//	$response->assertRedirect('/themes');
	//}

	/**
	 * Test if the user can login
	 *
	 * @return void
	 */
	public function test_user_can_login()
	{
		$user = User::factory()->create();

		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'password'
		]);

		$response->assertRedirect('/calendar');
	}

	/**
	 * Test if the invalid login doesn't log in
	 *
	 * @return void
	 */
	public function test_user_cannot_login_if_password_is_incorrect()
	{
		$user = User::factory()->create();

		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'incorrect_password'
		]);

		$response->assertSessionHasErrors([
			'validation' => 'The provided credentials do not match our records.',
		]);
	}
}

