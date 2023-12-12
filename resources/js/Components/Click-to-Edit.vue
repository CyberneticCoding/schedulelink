<template>
	<div>
		<input type="text"
			:class="['p-0 m-0 w-auto', fontSize]"
			v-if="edit"
			v-model="localValue"
			@input="updateParent"
			@blur="onBlur"
			@keyup.enter="onBlur"
			v-focus
		/>
		<p v-else @click="edit = true;">
			{{ localValue }}
		</p>

	</div>
</template>

<script>
export default {
	name: "Click-to-Edit",
	props: {
		value: String,
		fontSize: String,
	},
	data() {
		return {
			edit: false,
			localValue: this.value,
		};
	},
	methods: {
		onBlur() {
			this.edit = false;
			this.updateParent()
		},
		updateParent() {
			this.$emit("input", this.localValue)
		}
	},
	directives: {
		focus: {
			mounted(el) {
				el.focus();
			},
		},
	},
};
</script>
