<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeBlock;
use App\Models\AvailabilityItem;
use App\Models\CalendarItem;
use App\Models\TimeBlock;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class CalendarController extends Controller
{
	public function index($week = null)
	{
		$validator = validator(['week' => $week], [
			'week' => 'nullable|date',
		]);
		if (!$validator->passes()) {
			return redirect()->route('calendar');
		}

		list($startDate, $currentDate, $endDate) = $this->calculateDates($week);

		$calendarItems = $this->getTimeBlocks(auth()->user()->calendarItems(), $startDate, $endDate);
		return Inertia::render('MainCalendarPage', [
			'calendarItems' => $calendarItems,
			'week' => [
				'first_day' => $startDate,
				'current_day' => $currentDate,
				'last_day' => $endDate,
			],
		]);
	}

	public function availability($week = null)
	{
		//$validator = validator(['week' => $week], [ //todo implement week switching for availabilty
		//	'week' => 'nullable|date',
		//]);
		//if (!$validator->passes()) {
		//	return redirect()->route('availability');
		//}

		list($startDate, $currentDate, $endDate) = $this->calculateDates($week);

		$availabilityItems = $this->getTimeBlocks(auth()->user()->availabilityItems(), $startDate, $endDate);

		return Inertia::render('AvailabilityCalendarPage', [
			'availabilityItems' => $availabilityItems,
			'week' => [
				'first_day' => $startDate,
				'current_day' => $currentDate,
				'last_day' => $endDate,
			],
		]);
	}

	public function combined($week = null) {
		$validator = validator(['week' => $week], [
			'week' => 'nullable|date',
		]);
		if (!$validator->passes()) {
			return redirect()->route('combined');
		}

		list($startDate, $currentDate, $endDate) = $this->calculateDates($week);

		$calendarItems = $this->getTimeBlocks(auth()->user()->calendarItems(), $startDate, $endDate);

		$activeCompany = auth()->user()->activeCompany;
		$companyMembers = [];

		if ($activeCompany) {
			$companyMembers = $activeCompany->users->map(function ($user) {
				return [
					'value' => $user->first_name . ' ' . $user->last_name,
					'email' => $user->email,
				];
			});
		}
		return Inertia::render('CombinedCalendarPage', [
			'combinedItems' => $calendarItems,
			'week' => [
				'first_day' => $startDate,
				'current_day' => $currentDate,
				'last_day' => $endDate,
			],
			'companyMembers' => $companyMembers
		]);
	}

	public function store(StoreTimeBlock $request)
	{
		return $this->storeTimeBlockAndRedirect($request, 'calendarItems');
	}
	public function storeAvailability(StoreTimeBlock $request)
	{
		return $this->storeTimeBlockAndRedirect($request, 'availabilityItems');
	}

	public function update(Request $request, $id)
	{
		return $this->updateTimeBlock($request, $id, 'calendarItems');
	}

	public function updateAvailability(Request $request, $id)
	{
		return $this->updateTimeBlock($request, $id, 'availabilityItems');
	}
	public function destroy(CalendarItem $calendarItem, Request $request)
	{
		$calendarItem->timeblock->forceDelete();
		$calendarItem->delete();
		$week = $request->query('week');
		return redirect()->route('calendar', ['week' => $week]);
	}

	public function destroyAvailability(AvailabilityItem $availabilityItem, Request $request)
	{
		$availabilityItem->timeblock->forceDelete();
		$availabilityItem->delete();
		$week = $request->query('week');
		return redirect()->route('availability', ['week' => $week]);
	}


	private function storeTimeBlockAndRedirect(Request $request, $relationship)
	{
		$start_time = Carbon::parse($request->start_time);
		if (!$request->stop_time) {
			// If 'stop_time' is not provided, calculate it as needed
			$stop_time = $start_time->copy()->addHour(); // Add 1 default hour
		} else {
			$stop_time = $request->stop_time;
		}

		$formattedData = [
			"start_time" => $start_time,
			"stop_time" => $stop_time,
			"name" => $request->name,
		];

		$validated = validator($formattedData, [
			'start_time' => 'required|date|before:stop_time',
			'stop_time' => 'required|date|after:start_time',
			'name' => 'required|string'
		])->validate();

		$timeBlock = TimeBlock::create([
			'name' => $validated['name'],
			'description' => $request->description ? $request->description : null,
			'start_time' => $validated['start_time'],
			'stop_time' => $validated['stop_time'],
			'color_id' => 1,
		]);

		$user = auth()->user();

		$user->$relationship()->create([
			'time_block_id' => $timeBlock->id,
			'user_id' => $user->id,
		]);

		return redirect()->route(request()->segment(1), ['week' => request()->segment(2)]);
	}


	public function updateTimeBlock(Request $request, $id, $relationship)
	{
		$formattedData = [
			'start_time' => $this->formatDateTime($request->start_time),
			'stop_time' => $this->formatDateTime($request->stop_time),
		];

		$validated = validator($formattedData + $request->only('name', 'description'), [
			'start_time' => 'required|date|before:stop_time',
			'stop_time' => 'required|date|after:start_time',
			'name' => 'required|string'
		])->validate();

		if ($relationship === "calendarItems") {
			$timeBlockItem = CalendarItem::with('timeblock')->findOrFail($id);
		}
		if ($relationship === "availabilityItems") {
			$timeBlockItem = AvailabilityItem::with('timeblock')->findOrFail($id);
		}
		$timeBlockItem->delete();

		$timeBlock = TimeBlock::create([
			'name' => $validated['name'],
			'description' => $request->description,
			'start_time' => $validated['start_time'],
			'stop_time' => $validated['stop_time'],
			'color_id' => 1,
		]);

		$user = auth()->user();

		$user->$relationship()->create([
			'time_block_id' => $timeBlock->id,
			'user_id' => $user,
		]);


		if ($relationship === "availabilityItems") {
			return redirect()->route('availability');
		}
		$week = $request->query('week');
		return redirect()->route('calendar', ['week' => $week]);
	}


	protected function calculateDates($week)
	{
		if ($week) {
			$startDate = Carbon::parse($week)->startOfWeek();
			$currentDate = Carbon::parse($week);
			$endDate = Carbon::parse($week)->endOfWeek();
		} else {
			$startDate = Carbon::now()->startOfWeek();
			$currentDate = Carbon::now();
			$endDate = Carbon::now()->endOfWeek();
		}

		return [$startDate, $currentDate, $endDate];
	}

	protected function getTimeBlocks($query, $startDate, $endDate)
	{
		return $query->with('timeblock.color')
			->whereHas('timeblock', function ($query) use ($startDate, $endDate) {
				$query->whereBetween('start_time', [$startDate, $endDate]);
			})
			->get();
	}
	protected function formatDateTime($dateTime)
	{
		$formattedDate = new DateTime($dateTime['date']);
		$formattedDate->setTime($dateTime['time']['hours'], $dateTime['time']['minutes'], 0);

		return $formattedDate->format('Y-m-d H:i:s');
	}
}