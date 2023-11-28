<template>
	<div class="flex h-full flex-col">
		<header class="flex flex-none items-center justify-between border-b border-gray-200 pl-6 pb-4 sm:px-6 sm:py-4">
			<div class="flex flex-col sm:flex-row text-xl font-bold leading-6 text-gray-900">
				<div class="flex items-center">
					<h1>{{ $t('calendar.calendar') }}:</h1>
					<!--Select Month/year/day/week menu-->
					<Menu as="div" class="relative">
						<MenuButton type="button" class="flex items-center">
							<span class="text-primary ml-2">{{ $t('calendar.week') }}</span>
							<i class="fa-solid fa-chevron-down fa-sm ml-2 h-5 w-5 mt-4" aria-hidden="true" />
						</MenuButton>
						<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
							<MenuItems class="absolute left:0 z-10 mt-3 w-36 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
								<div class="py-1">
									<MenuItem v-slot="{ active }">
										<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ $t('calendar.day_view') }}</a>
									</MenuItem>
									<MenuItem v-slot="{ active }">
										<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ $t('calendar.week_view') }}</a>
									</MenuItem>
									<MenuItem v-slot="{ active }">
										<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ $t('calendar.month_view') }}</a>
									</MenuItem>
									<MenuItem v-slot="{ active }">
										<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ $t('calendar.year_view') }}</a>
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
							<span class="sr-only">{{ $t('calendar.previous_week') }}</span>
							<i class="fa-solid fa-chevron-left ml-2 h-5 w-5" aria-hidden="true" />
						</button>
						<button type="button" class="border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative block">{{thisWeek}} <span class="text-gray-400"></span></button> <!-- todo - add year-->
						<button type="button" class="flex h-9 items-center justify-center rounded-r-full border-y border-r border-gray-300 text-gray-400 hover:text-gray-500 focus:relative w-9 pl-0 hover:bg-gray-50">
							<span class="sr-only">{{ $t('calendar.next_week') }}</span>
							<i class="fa-solid fa-chevron-right ml-2 h-5 w-5" aria-hidden="true" />
						</button>
					</div>
				</div>
			</div>

			<div class="flex items-center">
				<!--Change Availability button-->
				<div class="hidden md:ml-4 md:flex md:items-center">
					<div class="ml-6 h-6 w-px bg-gray-300" />
					<Link id="availability-button" href="/availability" v-if="ifMainCalendar" type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Change Availability</Link>
					<Link id="calendar-button" href="/calendar" v-if="ifAvailabilityCalendar" type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Cancel</Link>
					<button v-if="ifAvailabilityCalendar" type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save Changes</button>
				</div>
				<!--Hidden mobile foldable menu-->
				<Menu as="div" class="relative ml-6 md:hidden">
					<MenuButton class="mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500">
						<span class="sr-only">{{ $t('calendar.open_menu') }}</span>
						<i class="fa-solid fa-bars ml-2 h-5 w-5" aria-hidden="true" />
					</MenuButton>

					<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
						<MenuItems class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
							<div class="py-1">
								<MenuItem v-slot="{ active }">
									<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ $t('calendar.create_event') }}</a>
								</MenuItem>
							</div>
							<div class="py-1">
								<MenuItem v-slot="{ active }">
									<a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ $t('calendar.open_menu') }}</a>
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
						<div class="col-end-1 w-10 sm:w-14 bg-primary text-white flex justify-center items-center">{{ $t('calendar.time') }}</div>
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
						<div class="col-end-1 w-14 bg-primary text-white flex justify-center items-center">{{ $t('calendar.time') }}</div>
						<div v-for="(day, index) in daysOfWeek" :key="index" class="flex items-center justify-center py-3">
							<span :class="[day === currentDay ? 'bg-primary rounded-full p-2 text-white ' :  '']">{{ day }}</span>
						</div>
					</div>
				</div>
				<div class="flex flex-auto">
					<div class="sticky left-0 z-10 w-10 sm:w-14 flex-none bg-white ring-1 ring-gray-100" />
					<div class="grid flex-auto grid-cols-1 grid-rows-1">
						<!-- Horizontal lines -->
						<div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100 ggrid-rows-[repeat(24,minmax(2rem,1fr))] grid-rows-[repeat(24,minmax(2rem,1fr))]">
							<div>
								<div class="sticky left-0 z-20 -ml-14 mt-0.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">12AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">1AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">2AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">3AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">4AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">5AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">6AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">7AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">8AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">9AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">10AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">11AM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">12PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">1PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">2PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">3PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">4PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">5PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">6PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">7PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">8PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">9PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">10PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
							<div>
								<div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-10 sm:w-14 pr-2 text-right text-xs leading-5 text-gray-400">11PM</div>
							</div>
							<!--<div class="hidden sm:inline"/>-->
						</div>
						<!-- Vertical lines -->
						<div class="col-start-0 col-end-2 row-start-1 grid-cols-7 grid-rows-1 divide-x divide-gray-100 grid">
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
						<ol @click="handleGridClick" ref="calendar" class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100 grid-cols-7 ggrid-rows-[repeat(24,minmax(2rem,1fr))] grid-rows-[repeat(48,minmax(2rem,1fr))]">
							<TimeBlock
								v-for="timeBlock in timeBlocks"
								:key="timeBlock.timeblock.id"
								:name="type==='AvailabilityCalendar' ? '' : timeBlock.timeblock.name "
								:color="timeBlock.timeblock.color"
								:start_time="new Date(timeBlock.timeblock.start_time)"
								:stop_time="new Date(timeBlock.timeblock.stop_time)"
							></TimeBlock>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import TimeBlock from "../Components/TimeBlock.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
	name: "CalendarGrid",
	components: {
		TimeBlock,
		Link,
		Menu,
		MenuItems,
		MenuItem,
		MenuButton
	},
	props: {
		timeBlocks: Array,
		type: String,
	},
	data() {
		return {
			timezone: "Europe/Amsterdam",
			week: this.getWeekData(),
		}
	},
	methods: {
		handleGridClick(event) {
			const isTimeBlock = event.target.getAttribute("data-time-block") === "true";

			if (isTimeBlock) {
				alert("timeblock")
			} else {
				this.createNewTimeBlock()
			}
		},
		createNewTimeBlock() {
			const MIN_CALENDAR_SLOTS = 48;
			const DAY_COLUMNS = 7;

			function calculateTime(timeSlot) {
				// Calculate time from a time slot index
				const minutes = timeSlot * 30;
				return {
					hours: Math.floor(minutes / 60),
					minutes: minutes % 60,
				};
			}
			/* Get the position where was clicked */
			const grid = this.$refs.calendar;
			const clickPositionY = event.clientY - grid.getBoundingClientRect().top;
			const clickPositionX = event.clientX - grid.getBoundingClientRect().left;
			// Calculate the time slot based on the vertical click position on the grid and the size of the smallest calendar slot denomination
			const halfHourHeight = grid.clientHeight / MIN_CALENDAR_SLOTS;
			const timeSlot = Math.floor(clickPositionY / halfHourHeight);
			// Calculate the day (column) based on the horizontal click position on the grid
			const dayColumnWidth = grid.clientWidth / DAY_COLUMNS;
			const dayIndex = Math.floor(clickPositionX / dayColumnWidth) + 1; //the clicked day

			const currentDate = new Date();
			const currentDayOfWeek = currentDate.getDay(); //current week day, 0 - 6

			const dayDifference = dayIndex - currentDayOfWeek;

			// Calculate the date for the desired day by adding the day difference
			currentDate.setDate(currentDate.getDate() + dayDifference);

			const { hours, minutes } = calculateTime(timeSlot);
			currentDate.setHours(hours + 1);
			currentDate.setMinutes(minutes);

			const endpointMap = {
				MainCalendar: "/calendar",
				AvailabilityCalendar: "/availability",
				Combined: "/combined-calendar",
			};

			const endpoint = endpointMap[this.type];
			if (endpoint) {
				this.$inertia.post(endpoint, {
					name: this.type === "Combined" ? "Combined Event" : this.type === "AvailabilityCalendar" ? "Available" : "New Event",
					start_time: currentDate.toISOString(),
					stop_time: null,
					type: this.type,
				}, {
					preserveScroll: true,
				});
			}
		},
		formatDate(date, formatOptions) {
			return new Intl.DateTimeFormat("en-US", formatOptions).format(date);
		},
		getWeekData() {
			const currentDate = new Date();
			const currentDay = currentDate.getDay();
			const first = currentDate.getDate() - currentDay + (currentDay === 0 ? -6 : 1); // First day is the day of the month - the day of the week + 1 (if it's Sunday, start from Monday)

			// Calculate the first Monday
			const firstMonday = new Date(currentDate);
			firstMonday.setDate(first);
			// Calculate the last day (Sunday) by adding 6 days to the first Monday
			const lastSunday = new Date(firstMonday);
			lastSunday.setDate(firstMonday.getDate() + 6);

			return {
				firstday: firstMonday,
				currentday: currentDate,
				lastday: lastSunday,
			}
		}
	},
	computed: {
		ifMainCalendar() {
			return this.type === "MainCalendar"
		},
		ifAvailabilityCalendar() {
			return this.type === "AvailabilityCalendar"
		},
		daysOfWeek() {
			/*  returns something like [ "30 Mon", "31 Tue", "01 Wed", "02 Thu", "03 Fri", "04 Sat", "05 Sun" ] */
			const currentDate = new Date();
			const currentDayOfWeek = currentDate.getUTCDay(); // Get the current day of the week (0 = Sunday, 1 = Monday, etc.)

			const daysToSubtract = (currentDayOfWeek + 6) % 7; // Calculate the number of days to subtract to get to the previous Monday
			const previousMonday = new Date(currentDate);
			previousMonday.setUTCDate(currentDate.getUTCDate() - daysToSubtract); //first monday of the week

			const formatOptions = {
				timeZone: this.timezone,
				weekday: "short",
				day: "2-digit",
			};

			const dateArray = [];
			for (let i = 0; i < 7; i++) {  //add 7 days to the first monday to get a full week
				const date = new Date(previousMonday);
				date.setUTCDate(previousMonday.getUTCDate() + i);
				dateArray.push(this.formatDate(date, formatOptions));
			}

			return dateArray;
		},
		currentDay() {
			// Returns something like 08 Wed. Which is the current day
			return this.formatDate(new Date(), {
				timeZone: this.timezone,
				weekday: "short",
				day: "2-digit",
			});
		},
		thisWeek() {
			// Returns a string of the first date in the current week (based on timezone).
			// The dates are formatted in a string like: "15 Oct - 21 Oct"
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