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

						<DialogPanel class="w-full max-w-xs transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-al border-t-8 border-primary">
							<DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
								{{ timeBlock.timeblock.name }}
							</DialogTitle>
							<div class="mt-2 text-gray-500">
								<p class="text-sm text-gray-500 w-5/6">
									Lorem ipsum dolor sit amet suru consecutor eru Lorem ipsum dolor sit amet suru consecutor eru.
								</p>
							</div>
							<div class="mt-2 text-sm  text-gray-600 flex flex-col">
								<div class="flex gap-2">
									<i class="fa-solid fa-clock text-black transform translate-y-0.5"></i>
									<span>Location place</span>
								</div>
							</div>
							<div class="mt-2 text-sm text-gray-600 flex flex-col">
								<div class="flex gap-2">
									<i class="fa-solid fa-clock text-black transform translate-y-0.5"></i>
									<span>{{ timeBlock.timeblock.start_time }}</span>
								</div>
								<div class="flex gap-2">
									<i class="fa-solid fa-clock fa-flip-horizontal text-black transform translate-y-0.5"></i>
									<span>{{ timeBlock.timeblock.stop_time }}</span>
								</div>
							</div>

							<div class="mt-4 flex gap-4">
								<button
									type="button"
									class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
									@click="closeModal">
									Close
								</button>
								<button
									type="button"
									class="inline-flex justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
									@click="deleteTimeBlock">
									Delete
								</button>
							</div>
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

export default {
	name: "TimeBlockEdit",
	components: {
		TransitionRoot,
		TransitionChild,
		DialogPanel,
		DialogTitle,
		Dialog,
	},
	props: {
		open: Boolean,
		timeBlock: Object,
	},
	methods: {
		closeModal() {
			this.$emit("closeModal")
		},
		deleteTimeBlock() {
			alert("delete")
		},
	}
}
</script>
