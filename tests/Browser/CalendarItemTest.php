<?php

namespace Tests\Browser;

use App\Models\CalendarItem;
use App\Models\TimeBlock;
use App\Models\User;
use Database\Seeders\CalendarItemSeeder;
use Database\Seeders\ColorSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CalendarItemTest extends DuskTestCase
{
	use DatabaseMigrations;
    public function test_user_can_open_calendar_item(): void
    {
		$this->user = User::factory()->create([
			'email' => 'tester@schedulelink.com',
		]);

		$this->seed(ColorSeeder::class);
		$startTime = now()->startOfWeek();
		$stopTime = now()->startOfWeek()->addHour();
		$timeBlock = TimeBlock::factory()->create([
			'id' => '1',
			'start_time' => $startTime,
			'stop_time' => $stopTime,
			'color_id' => 1,
			'name' => 'FirstWeek',
		]);
		CalendarItem::factory()
			->for($this->user)
			->create([
				'time_block_id' => $timeBlock->id,
			]);

		$this->browse(function (Browser $browser) {
			$browser->loginAs($this->user);
			$browser->visit('/calendar')
				->waitForLocation('/calendar');
			$browser->assertSee('FirstWeek');
			$browser->click('#timeblock-1')
				->pause(1000);
			$browser->assertSee('All day');
		});
    }

	public function test_user_can_delete_calendar_item(): void
	{
		$this->user = User::factory()->create([
			'email' => 'tester@schedulelink.com',
		]);

		$this->seed(ColorSeeder::class);
		$startTime = now()->startOfWeek();
		$stopTime = now()->startOfWeek()->addHour();
		$timeBlock = TimeBlock::factory()->create([
			'id' => '1',
			'start_time' => $startTime,
			'stop_time' => $stopTime,
			'color_id' => 1,
			'name' => 'FirstWeek',
		]);
		CalendarItem::factory()
			->for($this->user)
			->create([
				'time_block_id' => $timeBlock->id,
			]);

		$this->browse(function (Browser $browser) {
			$browser->loginAs($this->user);
			$browser->visit('/calendar')
				->waitForLocation('/calendar');
			$browser->assertSee('FirstWeek');
			$browser->click('#timeblock-1')
				->pause(1000);
			$browser->assertSee('All day');
			$browser->click('#delete')
				->pause(1000);
			$browser->assertMissing('All day');
			$browser->assertMissing('FirstWeek');
		});
	}
}
