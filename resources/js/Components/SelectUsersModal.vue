<template>
	<TransitionRoot as="template" :show="open">
		<div as="div" class="relative z-1" @closse="open = false">
			<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
				<div class="fixed inset-0 bg-gray-500 bg-opacity-30 transition-opacity" />
			</TransitionChild>

			<div class="fixed inset-0 z-10 w-screen overflow-y-auto">
				<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="relative transform overflow-hidden rounded-lg border-2 border-dashed border-gray-300  bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6 ">
							<div>
								<div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full">
									<div class="fa-solid fa-people-group fa-2xl text-gray-400" aria-hidden="true" />
								</div>
								<div class="text-center">
									<h3 as="h3" class="text-base font-semibold leading-6 text-gray-900">Add people to Combined Calendar</h3>
									<div class="mt-2">
										<p class="mt-1 text-sm text-gray-500">You haven’t added any team members to your project yet. As the owner of this project, you can manage team member permissions.</p>
									</div>
								</div>
							</div>
							<div class="mt-5 sm:mt-6">
								<button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="open = false">Add people</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</div>
		</div>
	</TransitionRoot>
</template>

<script setup>
import { ref } from "vue"
import { TransitionChild, TransitionRoot } from "@headlessui/vue"

const open = ref(true)
</script>