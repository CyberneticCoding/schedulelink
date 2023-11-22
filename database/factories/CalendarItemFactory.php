<?php

namespace Database\Factories;

use App\Models\TimeBlock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeBlock>
 */
class CalendarItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	public function definition(): array
	{
		$user = User::factory();
		return [
			'user_id' => $user,
			'time_block_id' => TimeBlock::factory(),
		];
	}
}
