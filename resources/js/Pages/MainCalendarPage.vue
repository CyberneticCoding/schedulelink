<template>
	<MainLayout>
		<template #main>
			<div class="flex h-full flex-col">
				<header class="flex flex-none items-center justify-between border-b border-gray-200 px-6 py-4">
					<div class="flex items-center text-xl font-bold leading-6 text-gray-900">
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
						<!--Scroll through week menu-->
						<div class="ml-12 flex items-center">
							<div class="relative flex items-center rounded-full bg-white shadow-sm md:items-stretch">
								<button type="button" class="flex h-9 w-12 items-center justify-center rounded-l-full border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
									<span class="sr-only">Previous week</span>
									<i class="fa-solid fa-chevron-left ml-2 h-5 w-5" aria-hidden="true" />
								</button>
								<button type="button" class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">{{thisWeek}} <span class="text-gray-400"></span></button> <!-- todo - add year-->
								<span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden" />
								<button type="button" class="flex h-9 w-12 items-center justify-center rounded-r-full border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
									<span class="sr-only">Next week</span>
									<i class="fa-solid fa-chevron-right ml-2 h-5 w-5" aria-hidden="true" />
								</button>
							</div>
						</div>
					</div>

					<!--<time datetime="2022-01">January 2022</time>-->

					<div class="flex items-center">
						<!--Change Availability button-->
						<div class="hidden md:ml-4 md:flex md:items-center">
							<div class="ml-6 h-6 w-px bg-gray-300" />
							<button type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Change Availability</button>
						</div>
						<!--Hidden mobile foldable menu-->
						<Menu as="div" class="relative ml-6 md:hidden">
							<MenuButton class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500">
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
											<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Go to today</a>
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
				<div id="container" class="isolate flex flex-auto flex-col overflow-auto bg-white">
					<div style="width: 165%" class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
						<div id="containerNav" class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5 sm:pr-8">
							<div class="grid grid-cols-7 text-sm leading-6 text-gray-500 sm:hidden">
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									M
									<span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">10</span>
								</button>
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									T
									<span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">11</span>
								</button>
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									W
									<span class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">12</span>
								</button>
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									T
									<span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">13</span>
								</button>
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									F
									<span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">14</span>
								</button>
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									S
									<span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">15</span>
								</button>
								<button type="button" class="flex flex-col items-center pb-3 pt-2">
									S
									<span class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900">16</span>
								</button>
							</div>

							<div class="-mr-px hidden grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm leading-6 text-gray-500 sm:grid">
								<div class="col-end-1 w-14 bg-primary text-white flex justify-center items-center">Time</div>
								<div v-for="(day, index) in daysOfWeek" :key="index" class="flex items-center justify-center py-3">
									<span>{{ day }}</span>
								</div>
							</div>
						</div>
						<div class="flex flex-auto">
							<div class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100" />
							<div class="grid flex-auto grid-cols-1 grid-rows-1">
								<!-- Horizontal lines -->
								<div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100" style="grid-template-rows: repeat(48, minmax(3.5rem, 1fr))">
									<div id="containerOffset" class="row-end-1 h-7" />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">12AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">1AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">2AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">3AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">4AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">5AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">6AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">7AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">8AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">9AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">10AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">11AM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">12PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">1PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">2PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">3PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">4PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">5PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">6PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">7PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">8PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">9PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">10PM</div>
									</div>
									<div />
									<div>
										<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">11PM</div>
									</div>
									<div />
								</div>

								<!-- Vertical lines -->
								<div class="col-start-1 col-end-2 row-start-1 hidden grid-cols-7 grid-rows-1 divide-x divide-gray-100 sm:grid sm:grid-cols-7">
									<div class="col-start-1 row-span-full" />
									<div class="col-start-2 row-span-full" />
									<div class="col-start-3 row-span-full" />
									<div class="col-start-4 row-span-full" />
									<div class="col-start-5 row-span-full" />
									<div class="col-start-6 row-span-full" />
									<div class="col-start-7 row-span-full" />
									<div class="col-start-8 row-span-full w-8" />
								</div>

								<!-- Events -->
								<ol class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7 sm:pr-8" style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto">
									<li class="relative mt-px flex sm:col-start-3" style="grid-row: 74 / span 12">
										<a href="#" class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-blue-50 p-2 text-xs leading-5 hover:bg-blue-100">
											<p class="order-1 font-semibold text-blue-700">Breakfast</p>
											<p class="text-blue-500 group-hover:text-blue-700">
												<time datetime="2022-01-12T06:00">6:00 AM</time>
											</p>
										</a>
									</li>
									<li class="relative mt-px flex sm:col-start-3" style="grid-row: 92 / span 30">
										<a href="#" class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-pink-50 p-2 text-xs leading-5 hover:bg-pink-100">
											<p class="order-1 font-semibold text-pink-700">Flight to Paris</p>
											<p class="text-pink-500 group-hover:text-pink-700">
												<time datetime="2022-01-12T07:30">7:30 AM</time>
											</p>
										</a>
									</li>
									<li class="relative mt-px hidden sm:col-start-6 sm:flex" style="grid-row: 122 / span 24">
										<a href="#" class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-gray-100 p-2 text-xs leading-5 hover:bg-gray-200">
											<p class="order-1 font-semibold text-gray-700">Meeting with design team at Disney</p>
											<p class="text-gray-500 group-hover:text-gray-700">
												<time datetime="2022-01-15T10:00">10:00 AM</time>
											</p>
										</a>
									</li>
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

export default {
	name: "MainCalendarPage",
	components: {
		MainLayout,
		Menu,
		MenuItems,
		MenuItem,
		MenuButton
	},
	methods: {
		getWeekData() {
			const currentDate = new Date();
			const first = currentDate.getDate() - currentDate.getDay() + (currentDate.getDay() === 0 ? -6 : 1); // First day is the day of the month - the day of the week + 1 (if it's Sunday, start from Monday)
			const last = first + 6; // last day is the first day + 6

			const timezone = "Europe/Amsterdam";

			const firstday = new Date(currentDate.setDate(first));
			const lastday = new Date(currentDate.setDate(last));

			return {
				firstday: firstday,
				lastday: lastday,
				timezone: timezone,
			}
		}
	},
	computed: {
		daysOfWeek() {
			// Returns an array of the days in the current week (based on timezone). The days are formatted like: 15 Mon, 16 Tue
			const week = this.getWeekData()

			const formatOptions = {
				timeZone: week.timezone,
				weekday: "short",
				day: "2-digit",
			};

			const formatDate = (date) => {
				return new Intl.DateTimeFormat("en-US", formatOptions).format(date);
			};

			const daysOfWeek = [];

			for (let i = 0; i <= 6; i++) {
				daysOfWeek.push(formatDate(new Date(week.firstday.getTime() + i * 24 * 60 * 60 * 1000)));
			}
			return daysOfWeek;
		},

		thisWeek() {
			// Returns an string of the first date in the current week (based on timezone). The dates are formatted in a string like: "15 Oct - 21 Oct"
			const week = this.getWeekData()

			const formatOptions = {
				timeZone: week.timezone,
				day: "2-digit",
				month: "short",
			};
			const formatDate = (date) => {
				return new Intl.DateTimeFormat("en-US", formatOptions).format(date);
			};

			return formatDate(week.firstday) + " - " + formatDate(week.lastday);
		}
	}
}
</script>