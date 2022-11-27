import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'vite-plugin-laravel/inertia'
import {Link} from "@inertiajs/inertia-vue3"
import flasher from "@flasher/flasher";
window.flasher = flasher; // only if you want to use it globally


createInertiaApp({
    title: (title) => `${title} - TeknoRotBalans`,
	resolve: (name) => resolvePageComponent(name, import.meta.glob('../views/pages/**/*.vue')),
	setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
			.use(plugin)
            // @ts-ignore
            .mixin({ methods: { route } })
            .component('Link', Link)
			.mount(el)
	},
})
