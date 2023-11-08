<template>
	<li :class="['relative mt-px flex', dayStyle]" :style="posStyle">
		<button data-time-block="true" :class="['text-left break-words group absolute inset-1 flex flex-col w-[96%] overflow-hidden rounded-lg p-1 text-xs leading-5' , color.primary_color, color.hover_color]">
			<span :class="['order-1 font-semibold', color.text_color]">{{ name }}</span>
			<span :class="['hidden sm:inline group-hover:text-blue-700', color.text_color]">
				<time :datetime="start_time">{{ formattedStartTime }}</time>
			</span>
			<!--{{ color}}-->
		</button>
	</li>
</template>


<script>
export default {
	name: "TimeBlock",
	props: {
		name: String,
		start_time: Date,
		stop_time: Date,
		color: Object,
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