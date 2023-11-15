<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SettingController;
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

Route::redirect('/', '/calendar');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register',[RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
	Route::get('/calendar', function () {
		return Inertia::render('MainCalendarPage');
	})->name('calendar');
	Route::get('/combined-calendar', function () {
		return Inertia::render('CombinedCalendarPage');
	});
	Route::get('/meetings', function () {
		return Inertia::render('MeetingsPage');
	});
	Route::get('/teams', function () {
		return Inertia::render('TeamsPage');
	});

	//	settings routes
	Route::redirect('/settings', '/settings/account');

	Route::get('/settings/account', [SettingController::class, 'accountPage']);
	Route::get('/settings/notifications', [SettingController::class, 'notificationsPage']);
	//Route::get('/settings/preferences', [SettingController::class, 'Settings2']);
	//Route::get('/settings/calendar-import', [SettingController::class, 'Settings2']);
	//Route::get('/settings/company', [SettingController::class, 'Details']);
	//Route::get('/settings/company/members', [SettingController::class, 'CompanyView']);
});
