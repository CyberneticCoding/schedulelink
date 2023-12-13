<template>
	<li :class="['relative flex', dayStyle]" :style="posStyle">
		<button :id="'timeblock-'+timeBlock.id" @click="handelClick()" data-time-block="true" :class="['text-left break-words group absolute inset-1 flex flex-col w-[96%] overflow-hidden rounded-lg p-1 text-xs leading-5' , primary_color, hover_color]">
			<span data-time-block="true" :class="['order-1 font-semibold', text_color]">{{ name }}</span>
			<span data-time-block="true" :class="['hidden sm:inline group-hover:text-blue-700', text_color]">
				<time data-time-block="true" :datetime="start_time">{{ formattedStartTime }}</time>
			</span>
		</button>
	</li>
</template>


<script>
export default {
	name: "TimeBlock",
	props: {
		timeBlock: Object,
	},
	data() {
		return {
			name: this.timeBlock.timeblock.name,
			primary_color: this.timeBlock.timeblock.color.primary_color,
			text_color: this.timeBlock.timeblock.color.text_color,
			hover_color: this.timeBlock.timeblock.color.hover_color,
			start_time: new Date(this.timeBlock.timeblock.start_time),
			stop_time: new Date(this.timeBlock.timeblock.stop_time),
		}
	},
	methods: {
		handelClick(){
			this.$emit("clicked", this.timeBlock)
		},
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
		let dayOfWeek = new Date(props.timeBlock.timeblock.start_time).getDay();
		if (dayOfWeek === 0) dayOfWeek = 7
		const dayStyle = `col-start-${dayOfWeek}`;
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