<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;


class RegistrationTest extends TestCase
{
	/**
	 * Test if the user can see the registration page
	 *
	 * @return void
	 */
	public function test_user_can_see_registration_page()
	{
		$response = $this->get('/register');
		$response->assertStatus(200);
		$response->assertInertia(fn (AssertableInertia $page) => $page
			->component('RegistrationPage')
		);
	}


	/**
	 * Test if the user can register
	 *
	 * @return void
	 */
	public function test_user_can_register()
	{
		$data = [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => fake()->unique()->email,
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass123'
		];
		$response = $this->post('/register', $data);

		// Controleer 302 'omleiding'
		$response->assertStatus(302);

		$response->assertRedirect('/');

		// Controleer database.
		$this->assertDatabaseHas('users', ['email' => $data['email']]);
	}

	/**
	 * Test if the invalid login doesn't log in
	 *
	 * @return void
	 */
	public function test_register_no_firstname()
	{
		$response = $this->post('/register', [
			'firstname' => '',
			'lastname' => fake()->lastName,
			'email' => fake()->unique()->email,
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass123'
		]);

		$response->assertSessionHasErrors([
			'firstname',
		]);
	}
	public function test_register_no_lastname()
	{
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => '',
			'email' => fake()->unique()->email,
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass123'
		]);

		$response->assertSessionHasErrors([
			'lastname',
		]);
	}
	public function test_register_no_email()
	{
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => '',
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass123'
		]);

		$response->assertSessionHasErrors([
			'email' => 'The email field is required.',
		]);
	}
	public function test_register_not_legit_email()
	{
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => fake()->firstName,
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass123'
		]);

		$response->assertSessionHasErrors([
			'email' => 'E-mail address is invalid',
		]);
	}
	public function test_register_existing_email()
	{
		$user = User::factory()->create();
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => $user->email,
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass123'
		]);

		$response->assertSessionHasErrors([
			'email' => 'The email has already been taken.',
		]);
	}
	public function test_register_no_password()
	{
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => fake()->unique()->email,
			'password' => '',
			'password_confirmation' => ''
		]);

		$response->assertSessionHasErrors([
			'password'=>'The password field is required.',
		]);
	}
	public function test_register_passwords_dont_match()
	{
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => fake()->unique()->email,
			'password' => 'Testpass123',
			'password_confirmation' => 'Testpass321'
		]);

		$response->assertSessionHasErrors([
			'password_confirmation'=>'Password fields don\'t match',
		]);
	}
	public function test_register_password_too_short()
	{
		$response = $this->post('/register', [
			'firstname' => fake()->firstName,
			'lastname' => fake()->lastName,
			'email' => fake()->unique()->email,
			'password' => 'Testpa',
			'password_confirmation' => 'Testpa'
		]);

		$response->assertSessionHasErrors([
			'password'=>'The password field must be at least 7 characters.',
		]);
	}
}
