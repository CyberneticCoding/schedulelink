<template>
	<SettingsLayout>
		<template #main>
			<div v-if="$page.props.auth.activeCompany" class="mx-auto ml-10" >
				<!--	Current company info	-->
				<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{$t('settings.company.details.title')}}</h3>
				<div>
					<div>
						<ul role="list" class="space-y-1">
							<li class="flex justify-between w-2/4">
								<div class="flex">
									<span class="pr-4">Company name:</span>
									<h1>{{ $page.props.auth.activeCompany.name }} </h1>
								</div>
								<div class="flex">
									<span class="pr-4">Owner:</span>
									<h1>{{ $page.props.auth.activeCompany.owner.first_name + "" + $page.props.auth.activeCompany.owner.last_name }}</h1>
								</div>
							</li>
							<li v-if="$page.props.auth.activeCompany.description">
								<div class="flex">
									<span class="pr-4">Description:</span>
									<h1>{{$page.props.auth.activeCompany.description}}</h1>
								</div>
							</li>
						</ul>
						<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.details.add_title') }}</h3>
						<div>

						</div>
						<div >
							<Link href="/settings/company/add" class="flex w-44 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
								{{ $t('settings.company.details.add_company') }}
							</Link>
						</div>
					</div>
				</div>
			</div>
		</template>
	</SettingsLayout>
</template>

<script>

import SettingsLayout from "../../../Layouts/SettingsLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
	name: "MembersPage",
	components: {
		SettingsLayout,
		Link
	},
	props: {
		companyMembers: Object,
	},
	methods: {
		removeUser(userId) {
			this.$inertia.post("/settings/company/members/remove", {
				userId: userId,
				companyId: this.$page.props.auth.activeCompany.id
			});
		},
	},
}
</script>