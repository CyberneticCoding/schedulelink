<template>
	<MainLayout>
		<template #main>
			<div class="flex h-full flex-col">
				<header class="flex flex-none items-center justify-between border-b border-gray-200 pl-6 pb-4 sm:px-6 sm:py-4">
					<div class="flex flex-col sm:flex-row text-xl font-bold leading-6 text-gray-900">
						<div class="flex items-center">
							<h1>Calendar:</h1>
							<!--Select Month/year/day/week menu-->
							<Menu as="div" class="relative">
								<MenuButton type="button" class="flex items-center">
									<span class="text-primary ml-2">Week</span>
									<i class="fa-solid fa-chevron-down fa-sm ml-2 h-5 w-5 mt-4" aria-hidden="true" />
								</MenuButton>
								<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
									<MenuItems class="absolute left:0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
										<div class="py-1">
											<MenuItem v-slot="{ active }">
												<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Day view</a>
											</MenuItem>
											<MenuItem v-slot="{ active }">
												<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Week view</a>
											</MenuItem>
											<MenuItem v-slot="{ active }">
												<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Month view</a>
											</MenuItem>
											<MenuItem v-slot="{ active }">
												<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Year view</a>
											</MenuItem>
										</div>
									</MenuItems>
								</transition>
							</Menu>
						</div>
						<!--Scroll through week menu-->
						<div class="sm:ml-12 flex items-center">
							<div class="relative flex rounded-full bg-white shadow-sm items-stretch">
								<button type="button" class="flex h-9 items-center justify-center rounded-l-full border-y border-l border-gray-300 text-gray-400 hover:text-gray-500 focus:relative w-9 pr-0 hover:bg-gray-50">
									<span class="sr-only">Previous week</span>
									<i class="fa-solid fa-chevron-left ml-2 h-5 w-5" aria-hidden="true" />
								</button>
								<button type="button" class="border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative block">{{thisWeek}} <span class="text-gray-400"></span></button> <!-- todo - add year-->
								<button type="button" class="flex h-9 items-center justify-center rounded-r-full border-y border-r border-gray-300 text-gray-400 hover:text-gray-500 focus:relative w-9 pl-0 hover:bg-gray-50">
									<span class="sr-only">Next week</span>
									<i class="fa-solid fa-chevron-right ml-2 h-5 w-5" aria-hidden="true" />
								</button>
							</div>
						</div>
					</div>

					<div class="flex items-center">
						<!--Change Availability button-->
						<div class="hidden md:ml-4 md:flex md:items-center">
							<div class="ml-6 h-6 w-px bg-gray-300" />
							<button type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Change Availability</button>
						</div>
						<!--Hidden mobile foldable menu-->
						<Menu as="div" class="relative ml-6 md:hidden">
							<MenuButton class="mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500">
								<span class="sr-only">Open menu</span>
								<i class="fa-solid fa-bars ml-2 h-5 w-5" aria-hidden="true" />
							</MenuButton>

							<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
								<MenuItems class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
									<div class="py-1">
										<MenuItem v-slot="{ active }">
											<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Create event</a>
										</MenuItem>
									</div>
									<div class="py-1">
										<MenuItem v-slot="{ active }">
											<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Change Availability</a>
										</MenuItem>
									</div>
									<div class="py-1">
										<!--<MenuItem v-slot="{ active }">-->
										<!--	<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Day view</a>-->
										<!--</MenuItem>-->
									</div>
								</MenuItems>
							</transition>
						</Menu>
					</div>
				</header>
				<div id="container" class="isolate flex flex-auto flex-col overflow-hidden bg-white">
					<div style="width: 165%" class="flex flex-none flex-col max-w-full">
						<div id="containerNav" class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5">
							<!-- Mobile Calendar header -->
							<div class="grid grid-cols-7 text-xs leading-6 text-gray-500 sm:hidden">
								<div class="col-end-1 w-10 sm:w-14 bg-primary text-white flex justify-center items-center">Time</div>
								<button
									v-for="(day, index) in daysOfWeek"
									:key="index"
									type="button"
									class="flex flex-col items-center pb-1 pt-2"
								>
									<span :class="[day === currentDay ? 'bg-primary rounded-full p-[0.3em] text-white w-12' :  'w-7', 'break-words  leading-4']">{{ day }}</span>
								</button>
							</div>
							<!-- Desktop Calendar header -->
							<div class="-mr-px hidden grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm leading-6 text-gray-500 sm:grid">
								<div class="col-end-1 w-14 bg-primary text-white flex justify-center items-center">Time</div>
								<div v-for="(day, index) in daysOfWeek" :key="index" class="flex items-center justify-center py-3">
									<span :class="[day === currentDay ? 'bg-primary rounded-full p-2 text-white ' :  '']">{{ day }}</span>
								</div>
							</div>
						</div>
						<div class="flex flex-auto">
							<div class="sticky left-0 z-10 w-10 sm:w-14 flex-none bg-white ring-1 ring-gray-100" />
							<div class="grid flex-auto grid-cols-1 grid-rows-1">
								<!-- Horizontal lines -->
								<div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100 grid-rows-[repeat(24,minmax(2rem,1fr))] sm:grid-rows-[repeat(48,minmax(2rem,1fr))]">
									<div>
										<div class="sticky left-0 z-20 -ml-14 mt-0.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">12AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">1AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">2AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">3AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">4AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">5AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">6AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">7AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">8AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">9AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">10AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">11AM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">12PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">1PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">2PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">3PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">4PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">5PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">6PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">7PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">8PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">9PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">10PM</div>
									</div>
									<div class="hidden sm:inline"/>
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">11PM</div>
									</div>
									<div class="hidden sm:inline"/>
								</div>
								<!-- Vertical lines -->
								<div class="col-start-0 col-end-2 row-start-1 grid-cols-7 grid-rows-1 divide-x divide-gray-100 grid sm:grid-cols-7">
									<div class="col-start-1 row-span-full" />
									<div class="col-start-2 row-span-full" />
									<div class="col-start-3 row-span-full" />
									<div class="col-start-4 row-span-full" />
									<div class="col-start-5 row-span-full" />
									<div class="col-start-6 row-span-full" />
									<div class="col-start-7 row-span-full" />
									<!--<div class="col-start-8 row-span-full w-8" />-->
								</div>
								<!-- Events -->
								<ol class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100 grid-cols-7 grid-rows-[repeat(24,minmax(2rem,1fr))] sm:grid-rows-[repeat(48,minmax(2rem,1fr))]">
									<li class="relative mt-px flex col-start-1 row-[8_/_span_4]">
										<a href="#" class="break-words group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-blue-50 p-1 text-xs leading-5 hover:bg-blue-100">
											<p class="order-1 font-semibold text-blue-700">Breakfast</p>
											<p class="hidden sm:inline text-blue-500 group-hover:text-blue-700">
												<time datetime="2022-01-12T06:00">6:00 AM</time>
											</p>
										</a>
									</li>
									<!--<li class="relative mt-px flex col-start-1 row-[74_/_span_12]">-->
									<!--	<a href="#" class="break-words group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-blue-50 p-1 text-xs leading-5 hover:bg-blue-100">-->
									<!--		<p class="order-1 font-semibold text-blue-700">Breakfast</p>-->
									<!--		<p class="hidden sm:inline text-blue-500 group-hover:text-blue-700">-->
									<!--			<time datetime="2022-01-12T06:00">6:00 AM</time>-->
									<!--		</p>-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li class="relative mt-px flex col-start-3 row-[92_/_span_30]">-->
									<!--	<a href="#" class="group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-pink-50 p-1 text-xs leading-5 hover:bg-pink-100">-->
									<!--		<p class="order-1 font-semibold text-pink-700">Flight to Paris</p>-->
									<!--		<p class="hidden sm:inline text-pink-500 group-hover:text-pink-700">-->
									<!--			<time datetime="2022-01-12T07:30">7:30 AM</time>-->
									<!--		</p>-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li class="relative mt-px flex col-start-6 " style="grid-row: 122 / span 24">-->
									<!--	<a href="#" class="group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-gray-100 p-1 text-xs leading-5 hover:bg-gray-200">-->
									<!--		<p class="order-1 font-semibold text-gray-700">Meeting with design team at Disney</p>-->
									<!--		<p class="hidden sm:inline text-gray-500 group-hover:text-gray-700">-->
									<!--			<time datetime="2022-01-15T10:00">10:00 AM</time>-->
									<!--		</p>-->
									<!--	</a>-->
									<!--</li>-->
									<TimeBlock name="Tester" :time_start="new Date('2023-11-08 02:00:0-00')" :time_stop="new Date('2023-11-08 04:00:0-00')"></TimeBlock>
									<TimeBlock name="Tester" :time_start="new Date('2023-11-09 00:00:0-00')" :time_stop="new Date('2023-11-09 08:00:0-00')"></TimeBlock>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</template>
	</MainLayout>
</template>
<script>
import MainLayout from "../Layouts/MainLayout.vue";
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import TimeBlock from "@/Components/TimeBlock.vue";

export default {
	name: "MainCalendarPage",
	components: {
		TimeBlock,
		MainLayout,
		Menu,
		MenuItems,
		MenuItem,
		MenuButton
	},
	data() {
		return {
			timezone: "Europe/Amsterdam",
			week: this.getWeekData(),
		}
	},
	methods: {
		getWeekData() {
			/* Returns something like:
				"firstday": "2023-10-30T11:18:37.644Z",
				"currentday": "2023-10-31T11:18:37.644Z",
				"lastday": "2023-11-05T11:18:37.644Z"
			 */
			const currentDate = new Date();
			const first = currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1); // First day is the day of the month - the day of the week + 1 (if it's Sunday, start from Monday)
			const last = first + 6; // last day is the first day + 6

			const currentday = new Date(currentDate);
			const firstday = new Date(currentDate.setDate(first));
			const lastday = new Date(currentDate.setDate(last));

			return {
				firstday: firstday,
				currentday: currentday,
				lastday: lastday,
			}
		},
		formatDate(date, formatOptions) {
			return new Intl.DateTimeFormat("en-US", formatOptions).format(date);
		}
	},
	computed: {
		daysOfWeek() {
			/*  [ "30 Mon", "31 Tue", "01 Wed", "02 Thu", "03 Fri", "04 Sat", "05 Sun" ] */
			// Returns an array of the days in the current week (based on timezone). The days are formatted like: ['15 Mon', '16 Tue']
			const formatOptions = {
				timeZone: this.timezone,
				weekday: "short",
				day: "2-digit",
			};

			const daysOfWeek = [];

			for (let i = 0; i <= 6; i++) {
				// Calculate a new date by adding 'i' days to the 'firstday' date until a week is formed.
				const day = new Date(this.week.firstday.getTime() + i * 24 * 60 * 60 * 1000)
				// Make the array
				daysOfWeek.push(this.formatDate(day, formatOptions));
			}
			return daysOfWeek;
		},
		currentDay() {
			return this.formatDate(new Date(), {
				timeZone: this.timezone,
				weekday: "short",
				day: "2-digit",
			});
		},
		thisWeek() {
			// Returns a string of the first date in the current week (based on timezone). The dates are formatted in a string like: "15 Oct - 21 Oct"
			const formatOptions = {
				timeZone: this.timezone,
				day: "2-digit",
				month: "short",
			};
			return this.formatDate(this.week.firstday, formatOptions) + " - " + this.formatDate(this.week.lastday, formatOptions);
		},
	}
}
</script>