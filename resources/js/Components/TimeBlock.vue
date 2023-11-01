<template>
	<li :class="['relative mt-px flex', dayStyle]" :style="pos">
		<a href="#" class="break-words group absolute inset-1 flex flex-col overflow-hidden rounded-lg bg-blue-50 p-1 text-xs leading-5 hover:bg-blue-100">
			<p class="order-1 font-semibold text-blue-700">{{ name }}</p>
			<p class="hidden sm:inline text-blue-500 group-hover:text-blue-700">
				<time :datetime="time_stop">{{time_stop}}</time>
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
	setup(props) {


		const startTime = props.time_start
		const hours = ((startTime.getUTCHours() * 60) + startTime.getUTCMinutes()) / 60 //returns something like 4,5 for 4 and a half hours
		const dayOfWeek = startTime.getUTCDay();
		const dayStyle = `col-start-${dayOfWeek + 1}`;

		const stopTime = new Date(props.time_stop);
		const diffMinutes = (stopTime - startTime) / (1000 * 60);
		const length = diffMinutes / 30;


		const minTimeBlockRange = 6 // half hour
		const timeStartRowPosition = Math.round(hours * 12) + 2 //add the + 2 because first 2 rows are weird. timeStartRowPosition is the placement of the timeblock on the vertical scale. Half hour is 6.

		const pos = "grid-row: "+ timeStartRowPosition + " / span " + minTimeBlockRange * length  //results in something like grid-row: 74 / span 12

		return {
			pos,
			dayStyle
		}
	},
}
</script>