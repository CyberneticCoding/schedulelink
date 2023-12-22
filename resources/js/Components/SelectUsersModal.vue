<template>
	<TransitionRoot as="template" :show="open">
		<div as="div" class="relative z-1" @closse="open = false">
			<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
				<div class="fixed inset-0 bg-gray-500 bg-opacity-30 transition-opacity" />
			</TransitionChild>

			<div class="fixed inset-0 z-10 w-full overflow-y-auto">
				<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="relative transform overflow-hidden rounded-lg border-2 border-dashed border-gray-300 bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6 ">
							<form @submit.prevent="submit">
								<div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full">
									<div class="fa-solid fa-people-group fa-2xl text-gray-400" aria-hidden="true" />
								</div>
								<div class="">
									<h3 class="text-base font-semibold leading-6 text-gray-900 text-center">Add people to Combined Calendar</h3>
									<div class="mt-2 mb-4 text-center">
										<p class="mt-1 text-sm text-gray-500">You haven’t added any people to the combined calendar. To use the combined calendar, add people from your company.</p>
									</div>
									<input id="usersList" type="text" name="mcu" class="w-full" autocomplete>
								</div>
							</form>
							<div class="mt-5 sm:mt-6">
								<button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="open = false">Add people</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</div>
		</div>
	</TransitionRoot>
</template>

<script>
import { ref } from "vue"
import {
	TransitionChild,
	TransitionRoot
} from "@headlessui/vue"
import Tagify from "@yaireo/tagify"
import "@yaireo/tagify/dist/tagify.css";
import {useForm} from "@inertiajs/inertia-vue3";


export default {
	name: "SelectUsersModal",
	components: {
		TransitionChild,
		TransitionRoot
	},
	props: {
		companyMembers: Array,
	},
	setup() {
		const open = ref(true)
		return {
			open,
		}
	},
	data() {
		return {
			form: useForm({
				people: []
			})
		}
	},
	mounted() {
		const input = document.getElementById("usersList");

		var tagify = new Tagify(input, {
			whitelist: this.companyMembers,
			maxTags: 10,
			dropdown: {
				maxItems: 20,
				classname: "tags-look",
				enabled: 0,
				closeOnSelect: false
			}
		})

		tagify.on("add", (e) => {
			this.form.people.push(e.detail.data.value);
			alert(JSON.stringify(this.form))
		});

		tagify.on("remove", (e) => {
			alert(e.detail.data.value)
			const removedIndex = this.form.people.findIndex(
				(person) => person === e.detail.data.value
			);
			if (removedIndex !== -1) {
				this.form.people.splice(removedIndex, 1);
			}
		});
	},
	methods: {
		submit() {
			const form = this.form
			form.post("combined-calendar")
		},
	},
	computed: {
		hasActiveCompany() {
			return this.$page.props.auth.activeCompany !== null
		}
	},
}
</script>

<style scoped>
.tagify {
	width: 100%;
	max-width: 700px;
}
.tags-look .tagify__dropdown__item {
	display: inline-block;
	border-radius: 3px;
	padding: 0.3em 0.5em;
	border: 1px solid #ccc;
	background: #f3f3f3;
	margin: 0.2em;
	font-size: 0.85em;
	color: black;
	transition: 0s;
}
.tags-look .tagify__dropdown__item--active {
	color: black;
}
.tags-look .tagify__dropdown__item:hover {
	background: lightyellow;
	border-color: gold;
}

</style>