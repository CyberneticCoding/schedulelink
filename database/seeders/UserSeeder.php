<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$user = User::factory()->create([
			'first_name' => 'Admin',
			'last_name' => 'ScheduleLink',
			'email' => 'admin@schedulelink.com',
			'password' => Hash::make('test'),
		]);
		$company = Company::create([
			'name' => 'CompanyName',
			'owner_id' => $user->id,
			'description' => 'we pride ourselves on delivering top-notch [Products/Services] tailored to meet the unique needs of our clients.we are driven by a commitment to quality, integrity, and customer satisfaction.',
			]);
		$company2 = Company::create([
			'name' => 'CompanyTest',
			'owner_id' => $user->id,
			'description' => 'we pride ourselves on delivering top-notch [Products/Services] tailored to meet the unique needs of our clients.we are driven by a commitment to quality, integrity, and customer satisfaction.',
		]);
		$user->update(['active_company_id' => $company->id]);
		$company->users()->attach($user);
		$company2->users()->attach($user);

		$users = User::factory()
			->count(10)
			->create()
			->each(function ($user) use ($company) {
				$user->update(['active_company_id' => $company->id]);
			});

		$company->users()->attach($users);

    }
}
