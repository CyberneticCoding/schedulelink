<?php

namespace Database\Seeders;

use App\Models\AvailabilityItem;
use App\Models\TimeBlock;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailabilityItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$user = User::find(1);

		$firstMonday = now()->startOfWeek();

		for ($day = 0; $day < 5; $day++) {
			$startTime = $firstMonday->copy()->setHour(9)->setMinute(0);
			$stopTime = $firstMonday->copy()->setHour(17)->setMinute(0);

			$timeBlock = TimeBlock::factory()->create([
				'start_time' => $startTime,
				'stop_time' => $stopTime,
				'color_id' => 1,
				'name' => '',
			]);

			AvailabilityItem::factory()
				->for($user)
				->create([
					'time_block_id' => $timeBlock->id,
				]);

			$firstMonday->addDay();
		}

	}
}
