<?php

namespace Database\Seeders;

use App\Models\navigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
		// Clear the table before seeding to avoid duplicates
		DB::table('navigations')->truncate();

		// Seed with data


		// Default navigation data
		navigation::create([
			'group'=> 'default',
			'name'=> 'Calendar',
			'href'=> '/',
			'icon'=> 'fa-regular fa-calendar-days',
			'component'=> 'MainCalendarPage',
			'translation_key'=> 'layout.nav.main_calendar',
		]);
		navigation::create([
			'group'=> 'default',
			'name'=> 'Combined Calendar',
			'href'=> '/combined-calendar',
			'icon'=> 'fa-solid fa-calendar-week',
			'component'=> 'CombinedCalendarPage',
			'translation_key'=> 'layout.nav.combined_calendar',
		]);
		navigation::create([
			'group'=> 'default',
			'name'=> 'Meetings',
			'href'=> '/meetings',
			'icon'=> 'fa-regular fa-handshake',
			'component'=> 'MeetingsPage',
			'translation_key'=> 'layout.nav.meetings',
		]);
		navigation::create([
			'group'=> 'default',
			'name'=> 'Teams',
			'href'=> '/teams',
			'icon'=> 'fa-solid fa-people-group',
			'component'=> 'TeamsPage',
			'translation_key'=> 'layout.nav.teams',
		]);
		// Settings navigations data
		navigation::create([
			'group'=> 'settings',
			'name'=> 'Account',
			'href'=> '/settings',
			'icon'=> '',
			'component'=> 'Settings/AccountSettingsPage',
			'translation_key'=> 'layout.nav.settingsmenu.user.account',
		]);
		navigation::create([
			'group'=> 'settings',
			'name'=> 'Notifications',
			'href'=> '/',
			'icon'=> '',
			'component'=> '',
			'translation_key'=> 'layout.nav.settingsmenu.user.notifications',
		]);
		navigation::create([
			'group'=> 'settings',
			'name'=> 'Import',
			'href'=> '/',
			'icon'=> '',
			'component'=> '',
			'translation_key'=> 'layout.nav.settingsmenu.user.import',
		]);
		navigation::create([
			'group'=> 'settings',
			'name'=> 'Details',
			'href'=> '/',
			'icon'=> '',
			'component'=> '',
			'translation_key'=> 'layout.nav.settingsmenu.company.details',
		]);
		navigation::create([
			'group'=> 'settings',
			'name'=> 'Members',
			'href'=> '/',
			'icon'=> '',
			'component'=> '',
			'translation_key'=> 'layout.nav.settingsmenu.company.members',
		]);
		// User navigations data
		navigation::create([
			'group'=> 'user',
			'name'=> 'Logout',
			'href'=> '/logout',
			'icon'=> 'fa-solid fa-right-from-bracket',
			'method'=> 'POST',
			'translation_key'=> 'layout.nav.logout',
		]);
		// Bottom navigation button (Settings // Back)
		navigation::create([
			'group'=> 'button',
			'name'=> 'Settings',
			'href'=> '/settings',
			'icon'=> 'fa-solid fa-gear',
			'translation_key'=> 'layout.nav.settings',
		]);
		navigation::create([
			'group'=> 'button',
			'name'=> 'Back',
			'href'=> '/',
			'icon'=> '',
			'translation_key'=> 'layout.nav.settingsmenu.back',
		]);
	}
}
