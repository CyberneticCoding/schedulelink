<template>
	<TransitionRoot appear :show="open" as="template">
		<Dialog as="div" @close="closeModal" class="relative z-10">

			<div class="fixed inset-0 overflow-y-auto">
				<div class="flex min-h-full items-center justify-center p-4 text-center">
					<TransitionChild
						as="template"
						enter="duration-200 ease-out"
						enter-from="opacity-0 scale-95"
						enter-to="opacity-100 scale-100"
						leave="duration-100 ease-in"
						leave-from="opacity-100 scale-100"
						leave-to="opacity-0 scale-95"
					>

						<DialogPanel class="w-full max-w-sm transform  rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-al border-t-8 border-primary">
							<DialogTitle as="h3" class="text-lg font-bold leading-6 text-gray-900">
								{{ timeBlock.timeblock.name }}
							</DialogTitle>
							<div class="mt-2 text-gray-500">
								<p class="text-sm text-gray-500 w-5/6">
									Lorem ipsum dolor sit amet suru consecutor eru Lorem ipsum dolor sit amet suru consecutor eru.
								</p>
							</div>
							<form @submit.prevent="submit" class="mt-2 text-sm text-gray-600 flex flex-col gap-2">
								<div class="flex gap-2">
									<i class="fa-solid fa-location-dot text-black transform translate-y-0.5"></i>
									<span>Location place</span>
								</div>
								<div class="flex gap-2">
									<i class="fa-solid fa-clock text-black transform translate-y-2.5"></i>
									<DatePicker v-model="form.start_time.date" :clearable="false" :auto-apply="true" :enable-time-picker="false" name="start_date" id="start_date"></DatePicker>
									<DatePicker v-model="form.start_time.time" :clearable="false" time-picker name="start_time" id="start_time"></DatePicker>
								</div>
								<div class="flex gap-2">
									<i class="fa-solid fa-clock text-black transform translate-y-2.5"></i>
									<DatePicker v-model="form.stop_time.date" :clearable="false" :auto-apply="true" :enable-time-picker="false" name="stop_date" id="stop_date"></DatePicker>
									<DatePicker v-model="form.stop_time.time" :clearable="false" time-picker name="stop_time" id="stop_time"></DatePicker>
								</div>
								<div class="flex gap-2">
									<input type="checkbox" id="all-day" name="all-day" class="transform translate-y-px">
									<label for="all-day">All day</label>
								</div>
								<div class="flex gap-4">
									<button
										type="button"
										class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
										@click="closeModal">
										<i class="fa-solid fa-xmark translate-y-0.5 mr-2"></i>
										Close
									</button>
									<button
										type="submit"
										class="inline-flex justify-center rounded-md border border-transparent bg-primary text-white px-4 py-2 text-sm font-medium hover:bg-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2">
										<i class="fa-solid fa-pen-to-square text-white translate-y-0.5 mr-2"></i>
										Submit
									</button>
									<button
										id="delete"
										type="button"
										class="inline-flex justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
										@click="deleteTimeBlock">
										<i class="fa-solid fa-trash translate-y-0.5 mr-2"></i>
										Delete
									</button>
								</div>
							</form>
						</DialogPanel>

					</TransitionChild>
				</div>
			</div>
		</Dialog>
	</TransitionRoot>
</template>

<script>
import {
	TransitionRoot,
	TransitionChild,
	Dialog,
	DialogPanel,
	DialogTitle,
} from "@headlessui/vue"
import DatePicker from "@vuepic/vue-datepicker"
import "@vuepic/vue-datepicker/dist/main.css";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
	name: "TimeBlockEdit",
	components: {
		TransitionRoot,
		TransitionChild,
		DialogPanel,
		DialogTitle,
		Dialog,
		DatePicker
	},
	props: {
		open: Boolean,
		timeBlock: Object,
		route: String,
	},
	data() {
		return {
			form: useForm({
				name: "New Event",
				start_time: {
					date: null,
					time: { hours: 0, minutes: 0 },
				},
				stop_time: {
					date: null,
					time: { hours: 0, minutes: 0 },
				},
			}),
		}
	},
	methods: {
		submit() {
			const weekData = window.location.pathname.split("/").pop();
			if (weekData !== "calendar" || (weekData !== "availability")) {
				this.form.patch(`/calendar/${this.timeBlock.id}?week=${weekData}`, {
					preserveScroll: true,
					onSuccess: () => {
						this.closeModal();
					},
				})
			} else {
				this.form.patch(`/calendar/${this.timeBlock.id}`, {
					preserveScroll: true,
					onSuccess: () => {
						this.closeModal();
					},
				})
			}
		},
		closeModal() {
			this.$emit("closeModal")
		},
		deleteTimeBlock() {
			const weekData = window.location.pathname.split("/").pop();
			if (weekData !== "calendar" || (weekData !== "availability")) {
				this.$inertia.delete(`/calendar/${this.timeBlock.id}?week=${weekData}`, {
					preserveScroll: true,
				});
			} else {
				this.$inertia.delete(`/calendar/${this.timeBlock.id}`, {
					preserveScroll: true,
				});
			}
			this.closeModal();
		},
	},
	watch: {
		timeBlock() {
			const start_time = new Date(this.timeBlock.timeblock.start_time);
			this.form.start_time.date = new Date(start_time.getTime() - (start_time.getTimezoneOffset() * 60000)).toISOString();
			this.form.start_time.time = {
				hours: start_time.getHours(),
				minutes: start_time.getMinutes(),
			};

			const stop_time = new Date(this.timeBlock.timeblock.stop_time);
			this.form.stop_time.date = new Date(stop_time.getTime() - (stop_time.getTimezoneOffset() * 60000)).toISOString();
			this.form.stop_time.time = {
				hours: stop_time.getHours(),
				minutes: stop_time.getMinutes(),
			};

		}
	}
}

</script>
<style scoped>
	.dp__theme_light {
		--dp-background-color: rgb(249 249 249);
	}
</style>
