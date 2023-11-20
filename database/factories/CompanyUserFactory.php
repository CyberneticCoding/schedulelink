<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyUser>
 */
class CompanyUserFactory extends Factory
{

    public function definition(): array
    {
		return [
			'user_id' => User::factory()->create()->id,
			'company_id' => Company::factory()->create()->id
		];
    }
}
