<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		User::factory()->count(10)->create();
		User::factory()->create([
			'first_name' => 'Admin',
			'last_name' => 'ScheduleLink',
			'email' => 'admin@schedulelink.com',
			'password' => 'test',
			'current_company' => '1'
		]);
		User::factory()->create([
			'first_name' => 'Admin2',
			'last_name' => 'ScheduleLink2',
			'email' => 'admin2@schedulelink.com',
			'password' => 'test',
		]);

    }
}
