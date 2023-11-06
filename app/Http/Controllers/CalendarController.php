<?php

namespace App\Http\Controllers;

use App\Models\TimeBlock;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index() {
		$timeBlocks = TimeBlock::all(); // Retrieve all time_blocks from the database

		return Inertia::render('MainCalendarPage', [
			'timeBlocks' => $timeBlocks, // Pass the time_blocks to the frontend
		]);
	}

}
