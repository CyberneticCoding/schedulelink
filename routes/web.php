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
	Route::get('/calendar/{week?}', [CalendarController::class, 'index'])->name('calendar');
	Route::post('/calendar/{week?}', [CalendarController::class, 'store'])->name('calendar.store');
	Route::delete('/calendar/{calendarItem}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
	Route::get('/availability/{week?}', [CalendarController::class, 'availability'])->name('availability');
	Route::post('/availability/{week?}', [CalendarController::class, 'storeAvailability'])->name('availability.store');
	Route::delete('/availability/{availabilityItem}', [CalendarController::class, 'destroyAvailability'])->name('availability.destroy');
	Route::get('/combined-calendar', function () {
		return Inertia::render('CombinedCalendarPage');
	});
	Route::get('/meetings', function () {
		return Inertia::render('MeetingsPage');
	});

	Route::get('/teams', function () {
		return Inertia::render('TeamsPage');
	});

	Route::redirect('/settings', '/settings/account');
	Route::get('/settings/account', [SettingController::class, 'accountPage'])->name('settings.account');
	Route::get('/settings/notifications', [SettingController::class, 'notificationsPage'])->name('settings.notifications');
	//Route::get('/settings/preferences', [SettingController::class, 'preferencesPage'])->name('settings.preferences');
	//Route::get('/settings/calendar-import', [SettingController::class, 'importPage'])->name('settings.import');
	Route::get('/settings/company', [SettingController::class, 'companyDetailsPage'])->name('settings.details');
	Route::get('/settings/company/members', [SettingController::class, 'companyMembersPage'])->name('companies.members');

	Route::group(['middleware' => ['checkCompanyOwnership']], function () {
		Route::get('/settings/company/members/add', [SettingController::class, 'companyMembersAddPage'])->name('companies.members.add');
		Route::post('/settings/company/members/remove', [SettingController::class, 'companyMembersRemove'])->name('companies.members.remove');
	});
});
