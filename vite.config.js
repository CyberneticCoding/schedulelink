import { defineConfig } from "vite"
import laravel from "laravel-vite-plugin"
import eslintPlugin from "vite-plugin-eslint"

import vue from "@vitejs/plugin-vue"

export default defineConfig({
	plugins: [
		vue(),
		eslintPlugin(),
		laravel({
			input: ["resources/css/app.css", "resources/js/app.js"],
			refresh: true,
		}),
	],
})