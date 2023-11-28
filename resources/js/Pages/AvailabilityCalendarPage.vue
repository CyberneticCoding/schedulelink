<template>
	<MainLayout>
		<template #main>
			<CalendarGrid type="AvailabilityCalendar" :time-blocks="availabilityItems"></CalendarGrid>
		</template>
	</MainLayout>
</template>
<script>
import CalendarGrid from "../Components/CalendarGrid.vue";
import MainLayout from "../Layouts/MainLayout.vue";

export default {
	name: "AvailabilityCalendarPage",
	props: {
		availabilityItems: Array,
	},
	components: {
		CalendarGrid,
		MainLayout
	},
}
</script>