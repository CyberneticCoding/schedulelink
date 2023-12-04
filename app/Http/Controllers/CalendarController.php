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
		//$data = $request->validated();

		$calendarItem = CalendarItem::with('timeblock')->findOrFail($id);

		$data = [
			'name' => $request->name,
			'start_time' => $this->formatDateTime($request->start_time),
			'stop_time' => $this->formatDateTime($request->stop_time),
		];

		$calendarItem->timeblock->update($data);

		return redirect()->route(request()->segment(1), ['week' => request()->segment(2)]);
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

	private function storeTimeBlockAndRedirect(Request $request, $relationship)
	{
		$data = $request->validated();
		if (!$data['stop_time']) {
			// If 'stop_time' is not provided, calculate it as needed
			$start_time = Carbon::parse($data['start_time']);
			$data['stop_time'] = $start_time->copy()->addHour(); // Add 1 default hour
		}

		$timeBlock = TimeBlock::create([
			'name' => $data['name'],
			'start_time' => $data['start_time'],
			'stop_time' => $data['stop_time'],
			'color_id' => 1,
		]);

		$user = auth()->user();

		// Determine the relationship based on the method name
		$user->$relationship()->create([
			'time_block_id' => $timeBlock->id,
			'user_id' => $user,
		]);

		return redirect()->route(request()->segment(1), ['week' => request()->segment(2)]);
	}
	protected function formatDateTime($dateTime)
	{
		$formattedDate = new DateTime($dateTime['date']);
		$formattedDate->setTime($dateTime['time']['hours'], $dateTime['time']['minutes'], 0);

		return $formattedDate->format('Y-m-d H:i:s');
	}
}