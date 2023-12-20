<template>
	<SettingsLayout>
		<template #main>
			<div class="mx-auto ml-10" >
				<!--	Member settings	-->
				<div >
					<h3 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ $t('settings.company.add_members.title') }}</h3>
					<div class="flex">

					</div>
				</div>
			</div>
		</template>
	</SettingsLayout>
</template>

<script>

import SettingsLayout from "../../../Layouts/SettingsLayout.vue";


export default {
	name: "MemberAddPage",
	components: {
		SettingsLayout
	},
	setup() {
		return {
		}
	},
}
</script>