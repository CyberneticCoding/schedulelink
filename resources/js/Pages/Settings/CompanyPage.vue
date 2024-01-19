<template>
	<SettingsLayout>
		<template #main>
			<div class="divide-y w-full">
				<!-- Profile Settings -->
				<div class="grid grid-cols-1 gap-x-8 gap-y-10 px-4 pb-16 py-8 sm:px-8 md:grid-cols-3 lg:px-20">
					<form class="md:col-span-2">
						<h3 class="mb-4 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.details.title') }}</h3>
						<div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:max-w-xl sm:grid-cols-6">
							<div class="flex flex-col col-span-full">
								<span>
									<b>Company Name:</b>
									{{ $page.props.auth.activeCompany.name }}
								</span>
								<span>
									<b>Company Owner:</b>
									{{ $page.props.auth.activeCompany.owner.name }}
								</span>
								<span v-if="$page.props.auth.activeCompany.description">
									<b>Company Description:</b>
									{{ $page.props.auth.activeCompany.description }}
								</span>
							</div>
						</div>
						<!--<div class="mt-8 flex">-->
						<!--	<button type="submit" class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>-->
						<!--</div>-->
					</form>
					<div class="mt-16">
						<h2 class="text-base font-semibold leading-7">Company Info</h2>
						<p class="mt-1 text-sm leading-6 text-gray-500">Manage the information that is associated with your company.</p>
					</div>
				</div>

				<!-- Add New company -->
				<div class="grid grid-cols-1 gap-x-8 gap-y-10 px-4 py-16 sm:px-8 md:grid-cols-3 lg:px-20">
					<form @submit.prevent="submit" class="md:col-span-2 space-y-4">
						<h3 class="mb-4 text-2xl font-bold leading-9 tracking-tight text-gray-900">Create a new Company</h3>
						<div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:max-w-xl sm:grid-cols-6">
							<div class="col-span-full">
								<label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.name') }}</label>
								<div class="mt-2">
									<input v-model="form.name" id="name" name="name" type="text" required autocomplete="company-name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div v-if="form.errors.name" style="color: red">{{form.errors.name}}</div>
							</div>
							<div class="col-span-full">
								<label for="description" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.description') }}</label>
								<div class="mt-2">
									<textarea v-model="form.description" id="description" name="description" autocomplete="company-description" class="block w-full h-32 resize-none rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" style="overflow-y: hidden;"></textarea>
								</div>
								<div v-if="form.errors.description" style="color: red">{{form.errors.description}}</div>
							</div>
							<div class="flex col-span-full">
								<label for="default" class="block text-sm pr-3 font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.default') }}</label>
								<input v-model="form.default" id="default" name="default" type="checkbox" class="block rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								<div v-if="form.errors.default" style="color: red">{{form.errors.default}}</div>
							</div>
							<div>
								<span class="block text-sm font-medium leading-6 text-gray-900 whitespace-nowrap	">* Fields are required</span>
								<button type="submit" :disabled="form.processing" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $t('settings.company.new_company.submit') }}</button>
							</div>
						</div>
					</form>

					<div class="mt-16">
						<h2 class="text-base font-semibold leading-7">Create Company</h2>
						<p class="mt-1 text-sm leading-6 text-gray-500">You are allowed to create multiple companies. Here you can add a new company.</p>
					</div>
				</div>


			</div>
		</template>
	</SettingsLayout>
</template>

<script>

import SettingsLayout from "../../Layouts/SettingsLayout.vue";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
	name: "AccountPage",
	components: {
		SettingsLayout
	},
	setup() {
		return {
			form: useForm({
				name: null,
				description: null,
				default: null,

			})
		}
	},
	methods: {
		submit() {
			const form = this.form
			form.post("/settings/company/add")
		},
		removeUser(userId) {
			this.$inertia.post("/settings/company/members/remove", {
				userId: userId,
				companyId: this.$page.props.auth.activeCompany.id
			});
		},
	},
	computed: {
		user() {
			return this.$page.props.auth.user
		}
	}
}
</script>