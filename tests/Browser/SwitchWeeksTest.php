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

class SwitchWeeksTest extends DuskTestCase
{
	use DatabaseMigrations;
    public function test_user_can_switch_between_weeks(): void
    {
		$this->user = User::factory()->create([
			'email' => 'tester@schedulelink.com',
		]);

		$this->seed(ColorSeeder::class);
		$startTime = now()->startOfWeek();
		$stopTime = now()->startOfWeek()->addHour();
		$timeBlock = TimeBlock::factory()->create([
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
			$browser->click('#next-week-button')
				->pause(1000);
			$browser->assertMissing('FirstWeek');
			$browser->click('#previous-week-button')
				->pause(1000);
			$browser->assertSee('FirstWeek');
		});
    }
}
