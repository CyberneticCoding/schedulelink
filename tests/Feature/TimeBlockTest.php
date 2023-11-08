<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\ColorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TimeBlockTest extends TestCase
{
    /**
     *
     */
    public function test_user_can_create_timeblock_without_stop_time(): void
    {
		$this->seed(ColorSeeder::class);
		$user = User::factory()->create();

		Auth::guard()->setUser($user);

		$name = fake()->unique()->name();
		$startTime = Carbon::create(2023, 11, 11, 13, 30, 0);
		$formatedStartTime = $startTime->format('Y-m-d H:i:s');

		$this->post('/calendar', [
			'start_time' => $formatedStartTime,
			'stop_time' => null,
			'name' => $name,
			'color_id' => '1',
		])->assertSessionHasNoErrors()->assertRedirect();

		$this->assertDatabaseHas('time_blocks', ['name' => $name]);
    }

	public function test_user_can_create_time_block_with_stop_time(): void
	{
		$this->seed(ColorSeeder::class);
		$user = User::factory()->create();

		Auth::guard()->setUser($user);

		$name = fake()->unique()->name();
		$startTime = Carbon::create(2023, 11, 11, 13, 30, 0);
		$stopTime = Carbon::create(2023, 11, 11, 16, 30, 0);
		$formatedStartTime = $startTime->format('Y-m-d H:i:s');
		$formatedStopTime = $stopTime->format('Y-m-d H:i:s');

		$this->post('/calendar', [
			'start_time' => $formatedStartTime,
			'stop_time' => $formatedStopTime,
			'name' => $name,
			'color_id' => '1',
		])->assertSessionHasNoErrors()->assertRedirect();

		$this->assertDatabaseHas('time_blocks', ['name' => $name]);
		$this->assertDatabaseHas('time_blocks', ['stop_time' => $stopTime]);
	}
}
