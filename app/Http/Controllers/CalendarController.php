<?php

namespace App\Http\Controllers;

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
			'timeBlocks' => $timeBlocks, // Pass the time_blocks to the frontend
		]);
	}


	public function store(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|string',
			'start_time' => 'required|date',
			'stop_time' => 'nullable|date|after:start_date',
		]);

		$timeBlock = new TimeBlock([
			'name' => $data['name'],
			'start_time' => $data['start_time'],
		]);


		// Check if 'stop_time' is provided and set it
		if ($data['stop_time']) {
			$timeBlock->stop_time = $data['stop_time'];
		} else {
			// If 'stop_time' is not provided, calculate it as needed
			$start_time = Carbon::parse($data['start_time']);
			$stop_time = $start_time->copy()->addHour(); // Add 1 default hour
			$timeBlock->stop_time = $stop_time;
		}

		$color = Color::find('1');
		$timeBlock->color_id = $color->id;

		$timeBlock->save();

		return redirect()->route('calendar');
	}
}