<template>
	<SettingsLayout>
		<template #main>
			<!--	Create new company	-->
			<div class="flex min-h-screen flex-1">
				<div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
					<div class="mx-auto w-full max-w-sm lg:w-96">
						<div>
							<h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.new_company.title') }}</h2>
						</div>

						<div class="mt-10">
							<div>
								<form @submit.prevent="submit" class="space-y-6">

									<div>
										<label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.name') }}</label>
										<div class="mt-2">
											<input v-model="form.name" id="name" name="name" type="text" required autocomplete="company-name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
										</div>
										<div v-if="form.errors.name" style="color: red">{{form.errors.name}}</div>
									</div>

									<div>
										<label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.description') }}</label>
										<div class="mt-2">
											<!--<textarea v-model="form.description" id="description" name="description" type="text" autocomplete="company-description" class="block w-full h-auto rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />-->
											<textarea v-model="form.description" id="description" name="description" autocomplete="company-description" class="block w-full h-32 resize-none rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" style="overflow-y: hidden;"></textarea>
										</div>
										<div v-if="form.errors.description" style="color: red">{{form.errors.description}}</div>
									</div>

									<div>
										<span class="block text-sm font-medium leading-6 text-gray-900">* Fields are required</span>
										<button type="submit" :disabled="form.processing" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $t('settings.company.new_company.submit') }}</button>
									</div>
								</form>


							</div>

						</div>
					</div>
				</div>
				<div class="relative hidden w-0 flex-1 lg:block">
					<img class="absolute inset-0 h-full w-full object-cover" src="../../../../img/register.jpg" alt="2 men scheduling a meeting" />
				</div>
			</div>
			<!--	oude code maar herbruikbaar voor pagina	-->
			<div >
				<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ "#OUD#" }}</h3>
				<ul role="list" class="-mx-2 space-y-1">
					<li v-for="item in accountsettingsTranslations" :key="item.name">
						<div class="mt-5">
							<ul>
								<li class="flex justify-between w-3/4">
									<div class="">
										<ul>
											<li>{{ $t(item.name) }}</li>
											<li class="text-sm" v-if="item.desc">{{ $t(item.desc) }}</li>
											<li class="text-sm" v-if="item.value==='email'">{{$page.props.auth.user.email}}</li>
										</ul>
									</div>
									<div >
										<button type="button" class="flex w-44 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
											{{ $t(item.change) }}</button>
									</div>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</template>
	</SettingsLayout>
</template>

<script>

import SettingsLayout from "../../../Layouts/SettingsLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import has from "has";


export default {
	name: "MemberAddPage",
	components: {
		SettingsLayout
	},
	setup() {
		const accountsettingsTranslations = [
			{ name: "settings_account.email.name",
				value: "email",
				change: "settings_account.email.change"},
			{ name: "settings_account.password.name",
				desc: "settings_account.password.description",
				change: "settings_account.password.change"},
			{ name: "settings_account.company.name",
				desc: "settings_account.company.description",
				change: "settings_account.company.change"},
			{ name: "settings_account.language.name",
				desc: "settings_account.language.description",
				change: "settings_account.language.change"},
			{ name: "settings_account.view.name",
				desc: "settings_account.view.description",
				change: "settings_account.view.change"},
		]
		return {
			accountsettingsTranslations,

			form: useForm({
				name: null,
				description: null,

			})
		}
	},

	methods: {
		has() {
			return has
		},
		submit() {
			const form = this.form
			form.post("/settings/company/add")
		}
	},

}
</script>