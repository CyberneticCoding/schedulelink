<?php

namespace Tests\Feature;

use App\Models\CalendarItem;
use App\Models\User;
use Database\Seeders\ColorSeeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TimeBlockTest extends TestCase
{

	function generateTimeBlock() {
		$name = fake()->unique()->name();
		$startTime = Carbon::create(2023, 11, 11, 13, 30, 0);
		$stopTime = Carbon::create(2023, 11, 11, 16, 30, 0);
		$formattedStartTime = $startTime->format('Y-m-d H:i:s');
		$formattedStopTime = $stopTime->format('Y-m-d H:i:s');
		return [
			'name' => $name,
			'start_time' => $startTime,
			'stop_time' => $stopTime,
			'formattedStartTime' => $formattedStartTime,
			'formattedStopTime' => $formattedStopTime,
		];
	}
    /**
     *
     */
    public function test_user_can_create_calendar_item_without_stop_time(): void
    {
		//This test is also to simulate the default value for a calendar Item.
		$this->seed(ColorSeeder::class);
		$user = User::factory()->create();

		Auth::guard()->setUser($user);

		$timeBlock = $this->generateTimeBlock();

		$this->post('/calendar', [
			'start_time' => $timeBlock['start_time'],
			'stop_time' => null,
			'name' => $timeBlock['name'],
			'color_id' => '1',
		])->assertSessionHasNoErrors()->assertRedirect();

		$this->assertDatabaseHas('time_blocks', ['name' => $timeBlock['name']]);
		$this->assertDatabaseHas('calendar_items', ['id' => '1']);

    }

	public function test_user_can_create_calendar_item_with_stop_time(): void
	{
		$this->seed(ColorSeeder::class);
		$user = User::factory()->create();

		Auth::guard()->setUser($user);

		$timeBlock = $this->generateTimeBlock();

		$this->post('/calendar', [
			'start_time' => $timeBlock['formattedStartTime'],
			'stop_time' => $timeBlock['formattedStopTime'],
			'name' => $timeBlock['name'],
			'color_id' => '1',
		])->assertSessionHasNoErrors()->assertRedirect();


		$this->assertDatabaseHas('time_blocks', ['name' => $timeBlock['name']]);
		$this->assertDatabaseHas('time_blocks', ['stop_time' => $timeBlock['stop_time']]);

		$this->assertDatabaseHas('calendar_items', ['id' => '2']);
	}

	public function test_user_can_create_availability_item_with_stop_time(): void
	{
		$this->seed(ColorSeeder::class);
		$user = User::factory()->create();

		Auth::guard()->setUser($user);

		$timeBlock = $this->generateTimeBlock();

		$this->post('/availability', [
			'start_time' => $timeBlock['formattedStartTime'],
			'stop_time' => $timeBlock['formattedStopTime'],
			'name' => $timeBlock['name'],
			'color_id' => '1',
		])->assertSessionHasNoErrors()->assertRedirect();


		$this->assertDatabaseHas('time_blocks', ['name' => $timeBlock['name']]);
		$this->assertDatabaseHas('time_blocks', ['stop_time' => $timeBlock['stop_time']]);

		$this->assertDatabaseHas('availability_items', ['id' => '1']);
	}

	function test_user_can_edit_calendar_item() {
		$this->seed(ColorSeeder::class);

		$user = User::factory()->make();
		Auth::guard()->setUser($user);

		$calendarItem = CalendarItem::factory()->create();

		$response = $this->patch('/calendar/'.$calendarItem->id, [
			'name' => 'TesterName',
			'description' => null,
			'start_time' => [
				'date' => '2023-12-14T04:30:00.000Z',
				'time' => [
					'hours' => 4,
					'minutes' => 30,
				],
			],
			'stop_time' => [
				'date' => '2023-12-14T12:30:00.000Z',
				'time' => [
					'hours' => 12,
					'minutes' => 30,
				],
			],
		]);
		$response->assertSessionHasNoErrors();
		$this->assertDatabaseHas('time_blocks', ['name' => 'TesterName']);
		$this->assertDatabaseHas('time_blocks', ['stop_time' => '2023-12-14T12:30:00.000Z']);
	}
}
