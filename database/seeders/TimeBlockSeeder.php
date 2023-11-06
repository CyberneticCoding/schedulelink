<?php

namespace Database\Seeders;

use App\Models\TimeBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		TimeBlock::factory()
			->count(5)
			->create();
   }
}
