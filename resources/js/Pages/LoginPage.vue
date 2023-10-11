<template>
	<MainLayout>
		<template #main>
			<div>
				<h1 class="bg-red-200 text-red-50">
					It is working
				</h1>
				<i class="fa-solid fa-cart-shopping" />
			</div>
		</template>
	</MainLayout>
</template>

<script>

import MainLayout from "@/Layouts/MainLayout.vue";

export default {
	name: "LoginPage",
	components: { MainLayout },
	mounted() {

	},
	data() {
		return {

		}
	},
	computed: {

	},
	watch: {

	}

}
</script>