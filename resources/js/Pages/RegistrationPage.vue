<template>
	<!--
		Code template for sign in from TailwindUI components
	-->
	<div class="flex min-h-screen flex-1">
		<div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
			<div class="mx-auto w-full max-w-sm lg:w-96">
				<div>
					<img class="h-16 w-auto" src="../../img/schedulelink-logo.png" alt="Logo Schedulelink" />
					<h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('register.register') }}</h2>
				</div>

				<div class="mt-10">
					<div>
						<form @submit.prevent="submit" class="space-y-6">


							<div>
								<label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('register.firstn') }}</label>
								<div class="mt-2">
									<input v-model="form.firstname" id="firstname" name="firstname" type="text" required autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div v-if="form.errors.firstname" style="color: red">{{form.errors.firstname}}</div>
							</div>

							<div>
								<label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('register.lastn') }}</label>
								<div class="mt-2">
									<input v-model="form.lastname" id="lastname" name="lastname" type="text" required autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div v-if="form.errors.lastname" style="color: red">{{form.errors.lastname}}</div>
							</div>

							<div>
								<label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('register.email') }}</label>
								<div class="mt-2">
									<input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div v-if="form.errors.email" style="color: red">{{form.errors.email}}</div>
							</div>

							<div>
								<label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('register.password') }}</label>
								<div class="mt-2">
									<input v-model="form.password" id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div v-if="form.errors.password" style="color: red">{{form.errors.password}} </div>
							</div>
							<div>
								<label for="password2" class="block text-sm font-medium leading-6 text-gray-900">{{ $t('register.password2') }}</label>
								<div class="mt-2">
									<input v-model="form.password_confirmation" id="password2" name="password2" required type="password" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
								</div>
								<div style="color: red">{{form.errors.password_confirmation}} </div>
							</div>


							<div>
								<span class="block text-sm font-medium leading-6 text-gray-900">* Fields are required</span>
								<button type="submit" :disabled="form.processing" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $t('register.submit') }}</button>
							</div>
						</form>


					</div>

				</div>
			</div>
		</div>
		<div class="relative hidden w-0 flex-1 lg:block">
			<img class="absolute inset-0 h-full w-full object-cover" src="../../img/register.jpg" alt="2 men scheduling a meeting" />
		</div>
	</div>
</template>

<script>

import {useForm} from "@inertiajs/inertia-vue3";
import has from "has";

export default {
	name: "LoginPage",
	setup() {
		return {
			form: useForm({
				firstname: null,
				lastname: null,
				email: null,
				password: null,
				password_confirmation: null,
			})
		}
	},
	methods: {
		has() {
			return has
		},
		submit() {
			const form = this.form
			form.post("/register")
		}
	},

	watch: {

	}

}
</script>
