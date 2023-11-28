<template>
	<SettingsLayout>
		<template #main>
			<div class="mx-auto ml-10" >
				<!--	Member settings	-->
				<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{"Company info"}}</h3>
				<div>
					<div>
						<ul role="list" class="space-y-1">
							<li class="flex justify-between w-2/4">
								<div class="flex">
									<span>Company name:</span>
									<h1>{{ $page.props.auth.activeCompany.name }} </h1>
								</div>
								<div class="flex">
									<span>Owner:</span>
									<h1>{{ $page.props.auth.activeCompany.owner.first_name + "" + $page.props.auth.activeCompany.owner.last_name }}</h1>
								</div>
							</li>
						</ul>
						<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.members.title') }}</h3>
						<div>
							<div>
								<ul role="list" class="space-y-2">

									<li v-for="member in companyMembers" :key="member.id" class="flex justify-between w-3/4">
										<div>
											<ul>
												<li>{{ member.first_name + "" + member.last_name }}</li>
												<li class="text-sm">{{ "extra info" }}</li>
											</ul>
										</div>
										<div>
											<Link @click="removeUser(member.id)" class="flex w-44 justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
												{{ "Remove" }}
											</Link>
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