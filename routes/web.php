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

//Route::resource('/', [UserController::class, 'show']);

Route::redirect('/', '/calendar');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register',[RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
	Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
	Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
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
	Route::get('/settings', [SettingController::class, 'AccountView']);
	Route::get('/settings/settings2', [SettingController::class, 'Settings2']);
	Route::get('/company', [SettingController::class, 'CompanyView']);
	Route::get('/company/members', [SettingController::class, 'CompanyMembersView']);
	Route::post('/company/members/remove', [SettingController::class, 'RemoveUserFromCompany']);
	Route::get('/company/members/add', [SettingController::class, 'CompanyAddMembersView']);

	Route::get('/user', [SettingController::class, 'CompanyMembers'])->name('currentUser');


	//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
	//Route::get('/logout', [LoginController::class, 'logout']);
});
