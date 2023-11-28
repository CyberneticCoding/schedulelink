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
		]);
		$user->update(['active_company_id' => $company->id]);
    }
}
