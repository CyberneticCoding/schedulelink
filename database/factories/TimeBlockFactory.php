<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeBlock>
 */
class TimeBlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	public function definition(): array
	{
// Generate a random hour and minutes, then round the minutes to the nearest half-hour
		$startHour = fake()->numberBetween(6, 13); // Random hour between 6 and 13 (1 PM)
		$startMinutes = fake()->randomElement([0, 30]); // Either 0 or 30 minutes
		$startTime = Carbon::now()->startOfWeek()->addDays(fake()->numberBetween(0, 6))->setHour($startHour)->setMinutes($startMinutes);

		// Generate a random hour and minutes for stopTime, then round the minutes to the nearest half-hour
		$stopHour = fake()->numberBetween(15, 18); // Random hour between 15 (3 PM) and 18 (6 PM)
		$stopMinutes = fake()->randomElement([0, 30]); // Either 0 or 30 minutes
		$stopTime = $startTime->copy()->setHour($stopHour)->setMinutes($stopMinutes);

		return [
			'start_time' => $startTime,
			'stop_time' => $stopTime,
			'name' => fake()->name(),
			'description' => fake()->sentence(),
		];
	}
}