<template>
	<SettingsLayout>
		<template #main>
			<!--	Create new company	-->
			<div class="w-full max-w-sm lg:w-96">
				<div>
					<h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.new_company.title') }}</h2>
				</div>
				<div class="mt-10">
					<div>
						<form @submit.prevent="submit" class="space-y-6">
							<div>
								<label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.name') }}</label>
								<div class="mt-2">
									<input v-model="form.name" id="name" name="name" type="text" required autocomplete="company-name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div v-if="form.errors.name" style="color: red">{{form.errors.name}}</div>
							</div>
							<div>
								<label for="description" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.description') }}</label>
								<div class="mt-2">
									<textarea v-model="form.description" id="description" name="description" autocomplete="company-description" class="block w-full h-32 resize-none rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" style="overflow-y: hidden;"></textarea>
								</div>
								<div v-if="form.errors.description" style="color: red">{{form.errors.description}}</div>
							</div>
							<div class="flex">
								<label for="default" class="block text-sm pr-3 font-medium leading-6 text-gray-900">{{ $t('settings.company.new_company.default') }}</label>
								<input v-model="form.default" id="default" name="default" type="checkbox" class="block rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								<div v-if="form.errors.default" style="color: red">{{form.errors.default}}</div>
							</div>
							<div>
								<span class="block text-sm font-medium leading-6 text-gray-900">* Fields are required</span>
								<button type="submit" :disabled="form.processing" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $t('settings.company.new_company.submit') }}</button>
							</div>
						</form>
					</div>
				</div>
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
		return {
			form: useForm({
				name: null,
				description: null,
				default: null,

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