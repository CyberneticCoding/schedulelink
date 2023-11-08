<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Color::create([
			'name' => 'Blue',
			'primary_color' => 'bg-blue-50',
			'hover_color' => 'hover:bg-blue-100',
			'text_color' => 'text-blue-700',
		]);

		Color::create([
			'name' => 'Amber',
			'primary_color' => 'bg-amber-50',
			'hover_color' => 'hover:bg-amber-100',
			'text_color' => 'text-amber-700',
		]);
    }
}
