<?php

namespace Database\Seeders;

use App\Models\CalendarItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalendarItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		CalendarItem::factory()
			->count(8)
			->for(User::find(1))
			->create();
    }
}
