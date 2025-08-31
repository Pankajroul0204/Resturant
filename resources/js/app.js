import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, router, usePage,Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import ToastPlugin, { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const toast = useToast();
router.on("finish", () => {
    if (usePage().props.flash.success || usePage().props.flash.error || usePage().props.flash.warning || usePage().props.flash.info) {
        toast.open({
            message: usePage().props.flash.success || usePage().props.flash.error || usePage().props.flash.warning || usePage().props.flash.info,
            type: usePage().props.flash.success ? 'success' : usePage().props.flash.error ? 'error' : usePage().props.flash.warning ? 'warning' : usePage().props.flash.info ? 'info' : 'default',
            duration: 2000,
            position: 'top-right',
        });
    }
});
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mixin({
                methods: {
                    route: window.route,
                },
            })
            .use(ToastPlugin)
            .component('Link',Link)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});


