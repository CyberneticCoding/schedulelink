<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::resource('/', [UserController::class, 'show']);
//Route::get('/', [LoginController::class, 'authenticate']);
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/combined-calendar', function () {
		return Inertia::render('CombinedCalendarPage');
	});
Route::get('/meetings', function () {
	return Inertia::render('MeetingsPage');
});
Route::get('/teams', function () {
	return Inertia::render('TeamsPage');
});


Route::get('/', function () {
    return Inertia::render('MainCalendarPage');
});
