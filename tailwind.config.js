/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	safelist: [
		'bg-blue-50',
		'hover:bg-blue-100',
		'text-blue-700',
		'bg-amber-50',
		'hover:bg-amber-100',
		'text-amber-700',
	],
	theme: {
		extend: {
			colors: {
				"primary": "#4B5CF7",
				"secondary": "#08048C",
				"tint": "#F5F7FA",
				"shadow": "#E8EAF6",
				"attention": "#08048C",
			},
			fontFamily: {
				manrope: ["Manrope", "sans-serif"],
			},
		}
	},
	plugins: [
		require("@tailwindcss/forms"),
	],
}

