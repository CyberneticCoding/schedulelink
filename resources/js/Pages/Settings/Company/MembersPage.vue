<template>
	<SettingsLayout>
		<template #main>
			<div class="mx-auto ml-10" >
				<!--	Member settings	-->
				<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{"Company info"}}</h3>
				<div>
					<div>
						<div>

						</div>
						<ul role="list" class="-mx-2 space-y-1">
							<li class="flex justify-between w-2/4">
								<div class="flex">
									Company name:
									<h1>{{$page.props.auth.activeCompany.name}}</h1>
								</div>
								<div class="flex">

									admin:
									<h1>{{$page.props.auth.activeCompany.owner.first_name+" "+ $page.props.auth.activeCompany.owner.last_name }}</h1>

								</div>
							</li>
						</ul>
						<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.members.title') }}</h3>
						<div>
							<div>
								<ul role="list" class="-mx-2 space-y-1">

									<li v-for="member in companyMembers" :key="member.id" class="flex justify-between w-3/4">

										<div>
											<ul>
												<li>{{member.first_name+" "+member.last_name }}</li>
												<li class="text-sm">{{ "evt extra info" }}</li>
											</ul>
										</div>
										<div >
											<Link @click="removeUser(member.user_id)" class="flex w-44 justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
												{{"Remove"}}</Link>
										</div>

									</li>
								</ul>
							</div>
						</div>
						<div >
							<Link href="members/add" class="flex w-44 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
								{{ $t('settings.company.members.add_members') }}
							</Link>
						</div>
					</div>
					<!--	oude code maar herbruikbaar voor pagina	-->
					<div >
					<!--					<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ "#OUD#" }}</h3>-->
					<!--					<ul role="list" class="-mx-2 space-y-1">-->
					<!--						<li v-for="item in accountsettingsTranslations" :key="item.name">-->
					<!--							<div class="mt-5">-->
					<!--								<ul>-->
					<!--									<li class="flex justify-between w-3/4">-->
					<!--										<div class="">-->
					<!--											<ul>-->
					<!--												<li>{{ $t(item.name) }}</li>-->
					<!--												<li class="text-sm" v-if="item.desc">{{ $t(item.desc) }}</li>-->
					<!--												<li class="text-sm" v-if="item.value==='email'">{{$page.props.auth.user.email}}</li>-->
					<!--											</ul>-->
					<!--										</div>-->
					<!--										<div >-->
					<!--											<button type="button" class="flex w-44 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">-->
					<!--												{{ $t(item.change) }}</button>-->
					<!--										</div>-->
					<!--									</li>-->
					<!--								</ul>-->
					<!--							</div>-->
					<!--						</li>-->
					<!--					</ul>-->
					</div>
				</div>
			</div>
		</template>
	</SettingsLayout>
</template>

<script>

import SettingsLayout from "../../../Layouts/SettingsLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default {
	name: "MembersPage",
	components: {
		SettingsLayout,
		Link
	},
	props: {
		companyMembers: Object,
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
			accountsettingsTranslations
		}
	},
	methods: {
		async removeUser(userId) {
			try {
				await axios.post("/settings/company/members/remove", { userId: userId, companyId: this.$page.props.auth.activeCompany.id });
				// Voeg hier eventueel logica toe om de gebruiker lokaal te verwijderen zonder de pagina opnieuw te laden
			} catch (error) {
				console.error("Error removing user:", error);
			}
		},
	},
}
</script>