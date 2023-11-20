<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Company::factory()->create([
			'id' => '1',
			'name' => 'Test Company 1',
			'owner_id' => '11'
		]);
    }
}
