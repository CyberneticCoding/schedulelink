<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeBlock;
use App\Models\AvailabilityItem;
use App\Models\CalendarItem;
use App\Models\Color;
use App\Models\TimeBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CalendarController extends Controller
{
	public function index()
	{
		$startDate = Carbon::now()->startOfWeek();
		$currentDate = Carbon::now();
		$endDate = Carbon::now()->endOfWeek();

		$calendarItems = auth()->user()
			->calendarItems()
			->with('timeblock.color')
			->whereHas('timeblock', function ($query) use ($startDate, $endDate) {
				$query->whereBetween('start_time', [$startDate, $endDate]);
			})->get();


		return Inertia::render('MainCalendarPage', [
			'calendarItems' => $calendarItems, // Pass the time_blocks to the frontend
			'week' => [
				'firstDay' => $startDate,
				'currentDay' => $currentDate,
				'lastDay' => $endDate,
			],
		]);
	}

	public function availability()
	{
		$availabilityItems = auth()->user()->availabilityItems()->with('timeblock.color')->get();
		return Inertia::render('AvailabilityCalendarPage', [
			'availabilityItems' => $availabilityItems, // Pass the time_blocks to the frontend
		]);
	}
	public function store(StoreTimeBlock $request)
	{
		return $this->storeTimeBlockAndRedirect($request, 'calendarItems', 'calendar');
	}
	public function storeAvailability(StoreTimeBlock $request)
	{
		return $this->storeTimeBlockAndRedirect($request, 'availabilityItems', 'availability');

	}





	public function storeTimeBlock($data) {
		return TimeBlock::create([
			'name' => $data['name'],
			'start_time' => $data['start_time'],
			'stop_time' => $data['stop_time'],
			'color_id' => 1,
		]);
	}
	private function storeTimeBlockAndRedirect(StoreTimeBlock $request, $relationship, $route)
	{
		$data = $request->validated();

		if (!$data['stop_time']) {
			// If 'stop_time' is not provided, calculate it as needed
			$start_time = Carbon::parse($data['start_time']);
			$data['stop_time'] = $start_time->copy()->addHour(); // Add 1 default hour
		}

		$timeBlock = $this->storeTimeBlock($data);

		$user = auth()->user();

		// Determine the relationship based on the method name
		$user->$relationship()->create([
			'time_block_id' => $timeBlock->id,
			'user_id' => $user,
		]);

		return redirect()->route($route);
	}
}