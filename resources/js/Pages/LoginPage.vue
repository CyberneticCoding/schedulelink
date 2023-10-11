<template>
	<!--
		Code template for sign in from TailwindUI components
	-->
	<MainLayout>
		<template #main>
			<div class="flex min-h-screen flex-1">
				<div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
					<div class="mx-auto w-full max-w-sm lg:w-96">
						<div>
							<img class="h-16 w-auto" src="../../img/schedulelink-logo.png" alt="Logo Schedulelink" />
							<h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Log in to your account</h2>
							<!--<p class="mt-2 text-sm leading-6 text-gray-500">-->
							<!--	Not a member?-->
							<!--	{{ ' ' }}-->
							<!--	<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Start a 14 day free trial</a>-->
							<!--</p>-->
						</div>

						<div class="mt-10">
							<div>
								<form @submit.prevent="submit" class="space-y-6">
									<div>
										<label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
										<div class="mt-2">
											<input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required="" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
											<div v-if="form.errors.password">{{ form.errors.password }}</div>
										</div>
									</div>

									<div>
										<label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
										<div class="mt-2">
											<input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" required="" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
											<div v-if="form.errors.password">{{ form.errors.password }}</div>
										</div>
									</div>

									<div class="flex items-center justify-between">
										<div class="flex items-center">
											<input v-model="form.remember" id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
											<label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-700">Remember me</label>
										</div>

										<div class="text-sm leading-6">
											<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
										</div>
									</div>

									<div>
										<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
				<div class="relative hidden w-0 flex-1 lg:block">
					<img class="absolute inset-0 h-full w-full object-cover" src="../../img/login-hero.png" alt="2 men scheduling a meeting" />
				</div>
			</div>
		</template>
	</MainLayout>
</template>

<script>

import MainLayout from "../Layouts/MainLayout.vue";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
	name: "LoginPage",
	components: {MainLayout},
	mounted() {

	},
	setup() {
		return {
			form: useForm({
				email: null,
				password: null,
				remember: false,
			})
		}
	},
	methods: {
		submit() {
			const form = this.form
			this.$inertia.post("/login", form)
		}
	},
	computed: {

	},
	watch: {

	}

}
</script>