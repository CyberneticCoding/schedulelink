<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\ColorSeeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TimeBlockTest extends TestCase
{
    /**
     *
     */
    public function test_user_can_create_calendar_item_without_stop_time(): void
    {
		//This test is also to simulate the default value for a calendar Item.
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
		$this->assertDatabaseHas('calendar_items', ['id' => '1']);

    }

	public function test_user_can_create_calendar_item_with_stop_time(): void
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

		$this->assertDatabaseHas('calendar_items', ['id' => '2']);
	}

	public function test_user_can_create_availability_item_with_stop_time(): void
	{
		$this->seed(ColorSeeder::class);
		$user = User::factory()->create();

		Auth::guard()->setUser($user);

		$name = fake()->unique()->name();
		$startTime = Carbon::create(2023, 11, 11, 13, 30, 0);
		$stopTime = Carbon::create(2023, 11, 11, 16, 30, 0);
		$formatedStartTime = $startTime->format('Y-m-d H:i:s');
		$formatedStopTime = $stopTime->format('Y-m-d H:i:s');

		$this->post('/availability', [
			'start_time' => $formatedStartTime,
			'stop_time' => $formatedStopTime,
			'name' => $name,
			'color_id' => '1',
		])->assertSessionHasNoErrors()->assertRedirect();


		$this->assertDatabaseHas('time_blocks', ['name' => $name]);
		$this->assertDatabaseHas('time_blocks', ['stop_time' => $stopTime]);

		$this->assertDatabaseHas('availability_items', ['id' => '1']);
	}
}
