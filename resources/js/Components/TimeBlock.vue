<template>
	<li :class="['relative mt-px flex', dayStyle, posStyle]" :style="posStyle">
		<a href="#" class="break-words group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-blue-50 p-1 text-xs leading-5 hover:bg-blue-100">
			<p class="order-1 font-semibold text-blue-700">{{ name }}</p>
			<p class="hidden sm:inline text-blue-500 group-hover:text-blue-700">
				<time :datetime="time_start">{{ formattedStartTime }}</time>
			</p>
		</a>
	</li>
</template>


<script>
export default {
	name: "TimeBlock",
	props: {
		name: String,
		time_start: Date,
		time_stop: Date,
		day: String, //like Wed, Mon
		length: Number  //in half hours
	},
	methods: {
		formatTime(time) {
			const hours = time.getUTCHours();
			const minutes = time.getUTCMinutes();
			const amPm = hours >= 12 ? "PM" : "AM";
			const formattedHours = (hours % 12) || 12;
			const formattedMinutes = minutes.toString().padStart(2, "0");
			return `${formattedHours}:${formattedMinutes} ${amPm}`;
		},
	},
	setup(props) {
		const dayOfWeek = props.time_start.getUTCDay();
		const dayStyle = `col-start-${dayOfWeek + 1}`;

		return {
			dayStyle,
		}
	},
	computed: {
		formattedStartTime() {
			return this.formatTime(this.time_start);
		},
		posStyle() {
			const startTime = this.time_start
			const stopTime = new Date(this.time_stop);

			const diffMinutes = (stopTime - startTime) / (1000 * 60); //difference between time_start and time_stop in minutes
			let length = diffMinutes / 30;  // how many half hours length this timeblock has

			const startTimeHour = (((startTime.getUTCHours() * 60) + startTime.getUTCMinutes()) / 60) + 0.5
			return "grid-row: " + startTimeHour * 2 + " / span " + length; // the event is

		}
	}
}
</script>