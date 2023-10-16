import { createApp, h } from "vue"
import { createInertiaApp } from "@inertiajs/inertia-vue3"
import {createI18n} from "vue-i18n";
import en_lang from "../lang/en.json";
import nl_lang from "../lang/nl.json";

createInertiaApp({
	resolve: name => {
		const pages = import.meta.glob("./Pages/**/*.vue", { eager: true })
		return pages[`./Pages/${name}.vue`]
	},
	setup({ el, App, props, plugin }) {
		const i18n = createI18n({
			locale: "en",
			fallbackLocale: "nl",
			globalInjection: true,
			messages: {
				en: en_lang,
				nl: nl_lang,
			},
		})
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.use(i18n)
			.mount(el)

	},
})


