<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		\App\Models\User::factory()->create([
			'first_name' => 'Admin',
			'last_name' => 'ScheduleLink',
			'email' => 'admin2@schedulelink.com',
			'password' => 'test',
		]);
    }
}
