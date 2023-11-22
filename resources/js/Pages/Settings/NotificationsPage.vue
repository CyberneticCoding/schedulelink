<template>
	<MainLayout>
		<template #main>
			<div class="mx-auto ml-10" >

			</div>
		</template>
	</MainLayout>
</template>

<script>

import MainLayout from "../../Layouts/MainLayout.vue";

export default {
	name: "NotificationsPage",
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