<?php

use App\Http\Controllers\CalendarController;
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


Route::redirect('/', '/calendar');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register',[RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
	Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
	Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
	Route::get('/availability', [CalendarController::class, 'availability'])->name('availability');
	Route::post('/availability', [CalendarController::class, 'storeAvailability'])->name('availability.store');
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
	Route::get('/settings/company', [SettingController::class, 'Details']);
	Route::get('/settings/company/members', [SettingController::class, 'CompanyMembersView']);

	Route::post('/settings/company/members/remove', [SettingController::class, 'RemoveUserFromCompany']);
	Route::get('/settings/company/members/add', [SettingController::class, 'CompanyAddMembersView']);
});
