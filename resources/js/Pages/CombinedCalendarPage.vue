<template>
	<MainLayout>
		<template #main>
			<CalendarGrid type="CombinedCalendar" :week="week"></CalendarGrid>
			<SelectUsersModal></SelectUsersModal>
		</template>
	</MainLayout>
</template>

<script>

import MainLayout from "../Layouts/MainLayout.vue";
import CalendarGrid from "../Components/CalendarGrid.vue";
import SelectUsersModal from "../Components/SelectUsersModal.vue";

export default {
	name: "CombinedCalendarPage",
	props: {
		calendarItems: Array,
		week: Object,
	},
	components: {
		CalendarGrid,
		MainLayout,
		SelectUsersModal
	},
}
</script>