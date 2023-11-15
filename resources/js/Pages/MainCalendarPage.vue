<template>
	<MainLayout>
		<template #main>
			<CalendarGrid type="MainCalendar" :time-blocks="calendarItems"></CalendarGrid>
		</template>
	</MainLayout>
</template>
<script>
import CalendarGrid from "../Components/CalendarGrid.vue";
import MainLayout from "../Layouts/MainLayout.vue";

export default {
	name: "MainCalendarPage",
	props: {
		calendarItems: Array,
	},
	components: {
		CalendarGrid,
		MainLayout
	},
}
</script>