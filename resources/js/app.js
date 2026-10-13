import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = 'InfoTravel | منصة السفر الذكية';

if (typeof window !== 'undefined') {
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    window.addEventListener('beforeunload', () => {
        window.scrollTo(0, 0);
    });
    window.addEventListener('load', () => {
        window.scrollTo(0, 0);
    });
    window.scrollTo(0, 0);
}

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#1E6BFF',
    },
});
