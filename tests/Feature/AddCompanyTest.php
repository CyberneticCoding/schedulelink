<?php


use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;


class AddCompanyTest extends TestCase
{
	use WithFaker, RefreshDatabase;
	/**
	 * Test if the user can see the add company page
	 *
	 * @return void
	 */
	public function test_user_can_see_add_company_page()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);

		$response = $this->get('/settings/company/add');
		$response->assertStatus(200);
		$response->assertInertia(fn(AssertableInertia $page) => $page
			->component('Settings/Company/CompanyAddPage')
		);
	}


	/**
	 * Test if the user can add a company
	 *
	 * @return void
	 */
	public function test_user_can_add_company()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);
		$data = [
			'name' => fake()->unique()->domainName,
			'description' => fake()->realTextBetween(maxNbChars: 255),
		];
		$response = $this->post('/settings/company/add', $data);

		// Controleer 302 'omleiding'
		$response->assertStatus(302);

		$response->assertRedirect('/settings/company');

		// Controleer database.
		$this->assertDatabaseHas('companies', ['name' => $data['name']]);
	}

	/**
	 * Test if the invalid login doesn't log in
	 *
	 * @return void
	 */
	public function test_user_cannot_add_company_with_empty_data()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);
		$response = $this->post('/settings/company/add', [
			'name' => '',
			'description' => '',
			'owner_id' => $user->id
		]);
		$response->assertSessionHasErrors([
			'name'
		]);

	}

	public function test_user_cannot_add_company_with_existing_name()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);
		$company = Company::factory()->create();
		$response = $this->post('/settings/company/add', [
			'name' => $company->name,
			'description' => fake()->realTextBetween(maxNbChars: 255),
			'owner_id' => $user->id
		]);

		$response->assertSessionHasErrors([
			'name'
		]);
	}

	public function test_user_cannot_create_company_when_description_too_long()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);
		$response = $this->post('/settings/company/add', [
			'name' => fake()->unique()->domainName,
			'description' => fake()->realTextBetween(minNbChars: 260, maxNbChars: 300),
			'owner_id' => $user->id
		]);

		$response->assertSessionHasErrors([
			'description',
		]);
	}
}
