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
	public function test_user_can_add_first_company()
	{
		$user = User::factory()->create();
		Auth::guard()->setUser($user);
		$data = [
			'name' => fake()->unique()->domainName,
			'description' => fake()->realTextBetween(maxNbChars: 255),
		];
		$response = $this->post('/settings/company/add', $data);

		// Check 302 'omleiding'
		$response->assertStatus(302);
		// Check redirect to company details
		$response->assertRedirect('/settings/company');

		// Check database. (company created, active company set to this company)
		$this->assertDatabaseHas('companies', ['name' => $data['name']]);
		$this->assertDatabaseHas('users', ['id' => $user->id, 'active_company_id' => Company::where('name', $data['name'])->first('id')->id]);
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
	public function test_user_can_create_company_and_set_as_active_company(){

		$user = User::factory()->create();
		Auth::guard()->setUser($user);
		$company = $this->setupTestcompany($user);

		// check if active company is set
		$this->assertDatabaseHas('users', ['id' => $user->id, 'active_company_id' => $company->id]);
		$data = [
			'name' => fake()->unique()->domainName,
			'description' => fake()->realTextBetween(maxNbChars: 255),
			'default' => true,
		];
		$response = $this->post('/settings/company/add', $data);

		// Check 302 'omleiding'
		$response->assertStatus(302);
		// Check redirect to company details
		$response->assertRedirect('/settings/company');
		// Check if company exists in DB
		$this->assertDatabaseHas('companies', ['name' => $data['name']]);
		// Check if user had active company set to created company
		$this->assertDatabaseHas('users', ['id' => $user->id, 'active_company_id' => Company::where('name', $data['name'])->first('id')->id]);
	}
	public function test_user_can_create_company_without_setting_active_company(){

	$user = User::factory()->create();
	Auth::guard()->setUser($user);
	$company = $this->setupTestcompany($user);

	// check if active company is set
	$this->assertDatabaseHas('users', ['id' => $user->id, 'active_company_id' => $company->id]);
	$data = [
		'name' => fake()->unique()->domainName,
		'description' => fake()->realTextBetween(maxNbChars: 255),
		'default' => false,
	];
	$response = $this->post('/settings/company/add', $data);

	// Check 302 'omleiding'
	$response->assertStatus(302);
	// Check redirect to company details
	$response->assertRedirect('/settings/company');
	// Check if company exists in DB
	$this->assertDatabaseHas('companies', ['name' => $data['name']]);
	// Check if user had active company not set to created company
	$this->assertDatabaseMissing('users', ['id' => $user->id, 'active_company_id' => Company::where('name', $data['name'])->first('id')->id]);
}

	public function setupTestcompany($user){
		$company = Company::create([
			'name' => 'TestCompany',
			'owner_id' => $user->id,
		]);
		$user->update(['active_company_id' => $company->id]);
		return $company;
	}
}
