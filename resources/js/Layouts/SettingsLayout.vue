<template>
	<TransitionRoot as="template" :show="sidebarOpen">
		<Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
			<TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
				<div class="fixed inset-0 bg-gray-900/80" />
			</TransitionChild>

			<!-- Sidebar for Mobile -->
			<div class="fixed inset-0 flex">
				<TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
					<DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
						<TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
							<div class="absolute left-full top-0 flex w-16 justify-center pt-5">
								<button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
									<span class="sr-only">{{ $t('layout.close_sidebar') }}</span>
									<i class="fa-solid fa-close h-6 w-6 text-white" aria-hidden="true" />
								</button>
							</div>
						</TransitionChild>
						<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-tint px-6 pb-4">
							<Link href="/">
								<picture class="flex h-20 shrink-0 items-center">
									<source media="(max-width: 600px)" srcset="../../img/schedulelink-logo.png">
									<source media="(max-width: 601px)" srcset="../../img/schedulelink-logo.png">
									<img class="h-12 w-auto" loading="eager" decoding="async" src="../../img/schedulelink-logo.png"
										alt="Logo schedulelink" width="280" height="380">
								</picture>
							</Link>
							<nav class="flex flex-1 flex-col">
								<ul role="list" class="flex flex-1 flex-col gap-y-7">
									<li>
										<ul role="list" class="-mx-2 space-y-1">
											<li>
												<h2> {{ $t("layout.nav.settingsmenu.usersettings") }}</h2>
											</li>
											<li>
												<Link href="/settings/account" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/AccountSettingsPage'	? 'bg-gray-50 text-indigo-600' : '']">
													<i :class="['fa-solid fa-user h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/AccountSettingsPage' ? 'text-primary' : '']" aria-hidden="true"/>
													{{ $t("layout.nav.settingsmenu.user.account") }}
												</Link>
											</li>
											<li>
												<Link href="/settings/notifications" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/NotificationsPage'	? 'bg-gray-50 text-indigo-600' : '']">
													<i :class="['fa-solid fa-bell h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/NotificationsPage' ? 'text-primary' : '']" aria-hidden="true"/>
													{{ $t("layout.nav.settingsmenu.user.notifications") }}
												</Link>
											</li>
											<li>
												<Link href="/settings/preferences" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/PreferencesPage' ? 'bg-gray-50 text-indigo-600' : '']">
													<i :class="['fa-solid fa-calendar-check h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/PreferencesPage' ? 'text-primary' : '']" aria-hidden="true"/>
													{{ $t("layout.nav.settingsmenu.user.preferences") }}
												</Link>
											</li>
											<li>
												<Link href="/settings/calendar-import" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/ImportPage' ? 'bg-gray-50 text-indigo-600' : '']">
													<i :class="['fa-solid fa-cloud-arrow-up h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/ImportPage' ? 'text-primary' : '']" aria-hidden="true"/>
													{{ $t("layout.nav.settingsmenu.user.import") }}
												</Link>
											</li>
											<li>
												<h2> {{ $t("layout.nav.settingsmenu.companysettings") }}</h2>
											</li>
											<li v-if="hasActiveCompany">
												<Link href="/settings/company" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/Company/DetailsPage' ? 'bg-gray-50 text-indigo-600' : '']">
													<i :class="['fa-solid fa-building h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/Company/DetailsPage' ? 'text-primary' : '']" aria-hidden="true"/>
													{{ $t("layout.nav.settingsmenu.company.details") }}
												</Link>
											</li>
											<li v-if="hasActiveCompany">
												<Link href="/settings/company/members" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/Company/MembersPage'	? 'bg-gray-50 text-indigo-600' : '']">
													<i :class="['fa-solid fa-users h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/Company/MembersPage' ? 'text-primary' : '']" aria-hidden="true"/>
													{{ $t("layout.nav.settingsmenu.company.members") }}
												</Link>
											</li>
										</ul>
									</li>
									<li class="mt-auto">
										<Link href="/calendar" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
											<i class="fa-solid fa-circle-left text-gray-400 group-hover:text-primary h-6 w-6 shrink-0 fa-xl translate-y-2.5" aria-hidden="true" />
											{{ $t('layout.nav.settingsmenu.back') }}
										</Link>
									</li>
								</ul>
							</nav>
						</div>
					</DialogPanel>
				</TransitionChild>
			</div>
		</Dialog>
	</TransitionRoot>



	<!-- Static sidebar for desktop -->
	<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-60 xl:w-72 lg:flex-col">
		<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-tint px-6 pb-4">
			<Link href="/">
				<picture class="flex h-20 shrink-0 items-center">
					<source media="(max-width: 600px)" srcset="../../img/schedulelink-logo.png">
					<source media="(max-width: 601px)" srcset="../../img/schedulelink-logo.png">
					<img class="h-12 w-auto" loading="eager" decoding="async" src="../../img/schedulelink-logo.png"
						alt="Logo schedulelink" width="280" height="380">
				</picture>
			</Link>
			<nav class="flex flex-1 flex-col">
				<ul role="list" class="flex flex-1 flex-col gap-y-7">
					<li>
						<ul role="list" class="-mx-2 space-y-1">
							<li>
								<h2> {{ $t("layout.nav.settingsmenu.usersettings") }}</h2>
							</li>
							<li>
								<Link href="/settings/account" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/AccountSettingsPage'	? 'bg-gray-50 text-indigo-600' : '']">
									<i :class="['fa-solid fa-user h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/AccountSettingsPage' ? 'text-primary' : '']" aria-hidden="true"/>
									{{ $t("layout.nav.settingsmenu.user.account") }}
								</Link>
							</li>
							<li>
								<Link href="/settings/notifications" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/NotificationsPage'	? 'bg-gray-50 text-indigo-600' : '']">
									<i :class="['fa-solid fa-bell h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/NotificationsPage' ? 'text-primary' : '']" aria-hidden="true"/>
									{{ $t("layout.nav.settingsmenu.user.notifications") }}
								</Link>
							</li>
							<li>
								<Link href="/settings/preferences" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/PreferencesPage' ? 'bg-gray-50 text-indigo-600' : '']">
									<i :class="['fa-solid fa-calendar-check h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/PreferencesPage' ? 'text-primary' : '']" aria-hidden="true"/>
									{{ $t("layout.nav.settingsmenu.user.preferences") }}
								</Link>
							</li>
							<li>
								<Link href="/settings/calendar-import" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/ImportPage' ? 'bg-gray-50 text-indigo-600' : '']">
									<i :class="['fa-solid fa-cloud-arrow-up h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/ImportPage' ? 'text-primary' : '']" aria-hidden="true"/>
									{{ $t("layout.nav.settingsmenu.user.import") }}
								</Link>
							</li>
							<li>
								<h2> {{ $t("layout.nav.settingsmenu.companysettings") }}</h2>
							</li>
							<li v-if="hasActiveCompany">
								<Link href="/settings/company" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/Company/DetailsPage' ? 'bg-gray-50 text-indigo-600' : '']">
									<i :class="['fa-solid fa-building h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/Company/DetailsPage' ? 'text-primary' : '']" aria-hidden="true"/>
									{{ $t("layout.nav.settingsmenu.company.details") }}
								</Link>
							</li>
							<li v-if="hasActiveCompany">
								<Link href="/settings/company/members" :class="['group flex gap-x-6 rounded-md p-2 text-sm leading-6 text-gray-700 hover:text-primary hover:bg-gray-50 font-semibold', $page.component === 'Settings/Company/MembersPage'	? 'bg-gray-50 text-indigo-600' : '']">
									<i :class="['fa-solid fa-users h-6 w-6 shrink-0 fa-xl translate-y-2.5 text-gray-400 group-hover:text-primary', $page.component === 'Settings/Company/MembersPage' ? 'text-primary' : '']" aria-hidden="true"/>
									{{ $t("layout.nav.settingsmenu.company.members") }}
								</Link>
							</li>
						</ul>
					</li>
					<li class="mt-auto">
						<Link href="/calendar" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
							<i class="fa-solid fa-circle-left text-gray-400 group-hover:text-primary h-6 w-6 shrink-0 fa-xl translate-y-2.5" aria-hidden="true" />
							{{ $t('layout.nav.settingsmenu.back') }}
						</Link>
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div class="lg:pl-60 xl:pl-72  w-screen">
		<div class="sticky top-0 z-40">
			<div class="flex h-16 items-center gap-x-4 border-b border-gray-200 px-4 shadow-sm sm:gap-x-6 sm:px-6 bg-white lg:px-8 lg:shadow-none">
				<button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
					<span class="sr-only">{{ $t('layout.close_sidebar') }}</span>
					<i class="fa-solid fa-bars h-6 w-6" aria-hidden="true" />
				</button>

				<!-- Separator -->
				<div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true" />

				<div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
					<form class="relative flex flex-1" action="#" method="GET">
						<label for="search-field" class="sr-only">{{ $t('layout.search') }}</label>
						<i class="fa-solid fa-search pointer-events-none absolute inset-y-0 top-[1.4em] left-0 h-full w-5 text-gray-400" aria-hidden="true" />
						<input id="search-field" class="block bg-white h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-600 focus:ring-0 sm:text-sm" placeholder="Search..." type="search" name="search" />
					</form>
					<div class="flex items-center gap-x-4 lg:gap-x-6">
						<button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
							<span class="sr-only">{{ $t('layout.view_notifications') }}</span>
							<i class="fa-regular fa-bell h-6 w-6" aria-hidden="true" />
						</button>

						<!-- Separator -->
						<div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true" />

						<!-- Profile dropdown -->
						<Menu as="div" class="relative">
							<MenuButton class="-m-1.5 flex items-center p-1.5">
								<span class="sr-only">{{ $t('layout.open_user_menu') }}</span>
								<img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
								<span class="hidden lg:flex lg:items-center">
									<span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
										{{ $page.props.auth.user.first_name }}
									</span>
									<i class="fa-solid fa-chevron-down ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
								</span>
							</MenuButton>
							<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
								<MenuItems class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
									<MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
										<Link :method="item.method" :href="item.href" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">
											{{ item.name }}
										</Link>
									</MenuItem>
								</MenuItems>
							</transition>
						</Menu>
					</div>
				</div>
			</div>
		</div>

		<main class="py-4">
			<div class="mx-auto max-w-7xl bg-white">
				<slot name="main"/>
			</div>
		</main>
	</div>
</template>
<script>

import { ref } from "vue"
import {
	Dialog,
	DialogPanel,
	Menu,
	MenuButton,
	MenuItem,
	MenuItems,
	TransitionChild,
	TransitionRoot,

} from "@headlessui/vue"
import {Link} from "@inertiajs/inertia-vue3";

export default {
	name: "MainLayout",
	components: {
		Dialog,
		DialogPanel,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		TransitionChild,
		TransitionRoot,
		Link,
	},
	setup() {
		const userNavigation = [
			{ name: "Logout", href: "/logout", method:"POST", icon: "fa-solid fa-right-from-bracket", translationKey: "layout.nav.logout"},
		]

		const sidebarOpen = ref(false)
		return {
			sidebarOpen,
			userNavigation,
		}
	},
	computed: {
		hasActiveCompany() {
			return this.$page.props.auth.activeCompany !== null
		}
	}
}
</script>
