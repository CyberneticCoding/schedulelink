<template>
	<SettingsLayout>
		<template #main>
			<div class="divide-y w-full">
				<!-- Profile Settings -->
				<div class="grid grid-cols-1 gap-x-8 gap-y-10 px-4 pb-16 py-8 sm:px-8 md:grid-cols-3 lg:px-20">
					<form class="md:col-span-2">
						<h3 class="mb-4 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.user.account.title.profile') }}</h3>
						<div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:max-w-xl sm:grid-cols-6">
							<div class="col-span-full flex items-center gap-x-8">
								<img class="h-32 w-32 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
								<div>
									<button type="button" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400">Change Profile Picture</button>
									<p class="mt-2 text-xs leading-5 text-gray-500">JPG, GIF or PNG. 1MB max.</p>
								</div>
							</div>

							<div class="sm:col-span-3">
								<label for="first-name" class="block text-sm font-medium leading-6">First name</label>
								<div class="mt-2">
									<input type="text" name="first-name" id="first-name" autocomplete="given-name" :value="user.first_name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
							</div>

							<div class="sm:col-span-3">
								<label for="last-name" class="block text-sm font-medium leading-6">Last name</label>
								<div class="mt-2">
									<input type="text" name="last-name" id="last-name" autocomplete="family-name" :value="user.last_name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
							</div>

							<div class="col-span-full">
								<label for="email" class="block text-sm font-medium leading-6">Email address</label>
								<div class="mt-2">
									<input id="email" name="email" type="email" autocomplete="email" :value="user.email" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
							</div>

							<div class="col-span-full">
								<label for="timezone" class="block text-sm font-medium leading-6">Timezone</label>
								<div class="mt-2">
									<select id="timezone" name="timezone" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
										<option>Pacific Standard Time</option>
										<option>Eastern Standard Time</option>
										<option>Greenwich Mean Time</option>
									</select>
								</div>
							</div>
						</div>

						<div class="mt-8 flex">
							<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
						</div>
					</form>
					<div class="mt-16">
						<h2 class="text-base font-semibold leading-7">Personal Information</h2>
						<p class="mt-1 text-sm leading-6 text-gray-500">Use a permanent address where you can receive mail.</p>
					</div>
				</div>

				<!-- Change Password -->
				<div class="grid grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-8 md:grid-cols-3 lg:px-20">
					<form class="md:col-span-2">
						<h3 class="mb-4 text-2xl font-bold leading-9 tracking-tight text-gray-900">Change Password</h3>
						<div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">

							<div class="col-span-full">
								<label for="current-password" class="block text-sm font-medium leading-6">Current password</label>
								<div class="mt-2">
									<input id="current-password" name="current_password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
							</div>

							<div class="col-span-full">
								<label for="new-password" class="block text-sm font-medium leading-6">New password</label>
								<div class="mt-2">
									<input id="new-password" name="new_password" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
							</div>

							<div class="col-span-full">
								<label for="confirm-password" class="block text-sm font-medium leading-6">Confirm password</label>
								<div class="mt-2">
									<input id="confirm-password" name="confirm_password" type="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
							</div>
						</div>

						<div class="mt-8 flex">
							<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
						</div>
					</form>
					<div class="mt-16">
						<h2 class="text-base font-semibold leading-7">Change password</h2>
						<p class="mt-1 text-sm leading-6 text-gray-500">Update your password associated with your account.</p>
					</div>
				</div>

				<!-- Delete Account-->
				<div class="grid grid-cols-1 gap-x-8 px-4 py-16 sm:px-8 lg:px-20">
					<div>
						<h3 class="mb-4 text-2xl font-bold leading-9 tracking-tight text-gray-900">Delete Account</h3>
						<p class="mt-1 text-sm leading-6 text-gray-500 max-w-md">No longer want to use our service? You can delete your account here. This action is not reversible. All information related to this account will be deleted permanently.</p>
						<h2 class="text-base font-semibold leading-7 text-white">Delete account</h2>
					</div>

					<form class="flex items-start md:col-span-2">
						<button type="submit" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400">Yes, delete my account</button>
					</form>
				</div>
			</div>
		</template>
	</SettingsLayout>
</template>

<script>

import SettingsLayout from "../../Layouts/SettingsLayout.vue";

export default {
	name: "AccountPage",
	components: {
		SettingsLayout
	},
	computed: {
		user() {
			return this.$page.props.auth.user
		}
	}
}
</script>