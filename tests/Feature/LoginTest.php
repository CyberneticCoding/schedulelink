<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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
		$this->assertAuthenticatedAs($user);
	}

	/**
	 * Test if the invalid login doesn't log in
	 *
	 * @return void
	 */
	public function test_user_cannot_login_if_password_is_incorrect()
	{
		$user = User::factory()->make();

		$response = $this->post('/login', [
			'email' => $user->email,
			'password' => 'incorrect_password'
		]);

		$response->assertSessionHasErrors([
			'validation' => 'The provided credentials do not match our records.',
		]);

		$this->assertFalse(Auth::check());
	}

	/**
	 * Test if an authenticated user cannot get to the login page
	 *
	 * @return void
	 */
	public function test_user_cannot_view_a_login_form_when_authenticated()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);

		$response = $this->actingAs($user)->get('/login');

		$response->assertRedirect('/calendar');
	}
}

