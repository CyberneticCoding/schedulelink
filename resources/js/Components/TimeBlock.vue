<template>
	<li :class="['relative mt-px flex', dayStyle]" :style="posStyle">
		<a href="#" class="break-words group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-blue-50 p-1 text-xs leading-5 hover:bg-blue-100">
			<p class="order-1 font-semibold text-blue-700">{{ name }}</p>
			<p class="hidden sm:inline text-blue-500 group-hover:text-blue-700">
				<time :datetime="start_time">{{ formattedStartTime }}</time>
			</p>
		</a>
	</li>
</template>


<script>
export default {
	name: "TimeBlock",
	props: {
		name: String,
		start_time: Date,
		stop_time: Date,
		day: String, //like Wed, Mon
		length: Number  //in half hours
	},
	methods: {
		formatTime(time) {
			const hours = time.getHours();
			const minutes = time.getMinutes();
			const amPm = hours >= 12 ? "PM" : "AM";
			const formattedHours = (hours % 12) || 12;
			const formattedMinutes = minutes.toString().padStart(2, "0");
			return `${formattedHours}:${formattedMinutes} ${amPm}`;
		},
	},
	setup(props) {
		const dayOfWeek = props.start_time.getDay();
		const dayStyle = `col-start-${dayOfWeek + 1}`;

		return {
			dayStyle,
		}
	},
	computed: {
		formattedStartTime() {
			return this.formatTime(this.start_time);
		},
		posStyle() {
			const startTime = this.start_time
			const stopTime = new Date(this.stop_time);
			const diffMinutes = (stopTime - startTime) / (1000 * 60); //difference between time_start and time_stop in minutes
			let length = Math.round(diffMinutes / 30);  // how many half hours length this timeblock has
			let startTimeHour = (((startTime.getHours() * 60) + startTime.getMinutes()) / 60) + 0.5 // returns hour of the day 0 to 24.
			return `grid-row: ${startTimeHour * 2} / span ${length}`;
		}
	}
}
</script>