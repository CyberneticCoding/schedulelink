<template>
	<SettingsLayout>
		<template #main>
			<div class="mx-auto ml-10" >
				<!--	Profile settings	-->
				<div >
					<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.user.account.title.profile') }}</h3>
					<div class="flex">
						<div>
							<img class="h-32 w-32 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
						</div>
						<div class="ml-8">
							<div class="flex">
								<span>{{ $page.props.auth.user.first_name }}</span>
								<span class="ml-2">{{ $page.props.auth.user.last_name }}</span>
							</div>
							<div>
								<div class="mt-8">
									<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">{{$t("settings.user.account.profile.name")}}</a>
								</div>
								<div>
									<a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">{{$t("settings.user.account.profile.picture")}}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--	Account settings	-->
				<div >
					<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.user.account.title.account') }}</h3>
					<ul role="list" class="-mx-2 space-y-1">
						<li v-for="item in accountsettingsTranslations" :key="item.name">
							<div class="mt-5">
								<ul>
									<li class="flex justify-between w-3/4">
										<div>
											<ul>
												<li>{{ $t(item.name) }}</li>
												<li class="text-sm" v-if="item.desc">{{ $t(item.desc) }}</li>
												<li class="text-sm" v-if="item.value==='email'">{{ $page.props.auth.user.email }}</li>
											</ul>
										</div>
										<div>
											<button class="flex w-44 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
												{{ $t(item.change) }}
											</button>
										</div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
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
	setup() {
		const accountsettingsTranslations = [
			{ name: "settings.user.account.email.name",
				value: "email",
				change: "settings.user.account.email.change"},
			{ name: "settings.user.account.password.name",
				desc: "settings.user.account.password.description",
				change: "settings.user.account.password.change"},
			{ name: "settings.user.account.company.name",
				desc: "settings.user.account.company.description",
				change: "settings.user.account.company.change"},
			{ name: "settings.user.account.language.name",
				desc: "settings.user.account.language.description",
				change: "settings.user.account.language.change"},
			{ name: "settings.user.account.view.name",
				desc: "settings.user.account.view.description",
				change: "settings.user.account.view.change"},
		]
		return {
			accountsettingsTranslations
		}
	}
}
</script>