<template>
	<MainLayout>
		<template #main>
			<CalendarGrid type="AvailabilityCalendar" :time-blocks="availabilityTimeBlocks"></CalendarGrid>
		</template>
	</MainLayout>
</template>
<script>
import CalendarGrid from "../Components/CalendarGrid.vue";
import MainLayout from "../Layouts/MainLayout.vue";

export default {
	name: "AvailabilityCalendarPage",
	props: {
		availabilityTimeBlocks: Array,
	},
	components: {
		CalendarGrid,
		MainLayout
	},
}
</script>