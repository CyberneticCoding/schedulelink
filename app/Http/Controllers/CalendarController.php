<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeBlock;
use App\Models\Color;
use App\Models\TimeBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class CalendarController extends Controller
{
	public function index()
	{
		$timeBlocks = TimeBlock::with('color')->get();
		return Inertia::render('MainCalendarPage', [
			'calendarTimeBlocks' => $timeBlocks, // Pass the time_blocks to the frontend
		]);
	}

	public function availability()
	{
		return Inertia::render('AvailabilityCalendarPage', [
			'availabilityTimeBlocks' => "", // Pass the time_blocks to the frontend
		]);
	}


	public function store(StoreTimeBlock $request)
	{
		$validated = $request->validated();

		$timeBlock = new TimeBlock([
			'name' => $validated['name'],
			'start_time' => $validated['start_time'],
		]);


		// Check if 'stop_time' is provided and set it
		if ($validated['stop_time']) {
			$timeBlock->stop_time = $validated['stop_time'];
		} else {
			// If 'stop_time' is not provided, calculate it as needed
			$start_time = Carbon::parse($validated['start_time']);
			$stop_time = $start_time->copy()->addHour(); // Add 1 default hour
			$timeBlock->stop_time = $stop_time;
		}

		$color = Color::find('1');
		$timeBlock->color_id = $color->id;

		$timeBlock->save();

		return redirect()->route('calendar');
	}
}