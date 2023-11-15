<template>
	<MainLayout>
		<template #main>
			<div class="mx-auto ml-10" >
				<!--	Member settings	-->
				<div >
					<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.members.title') }}</h3>
					<div class="flex">

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
			</div>
		</template>
	</MainLayout>
</template>

<script>

import MainLayout from "../../Layouts/MainLayout.vue";

export default {
	name: "SettingsPage",
	components: { MainLayout },
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
			accountsettingsTranslations
		}
	}
}
</script>