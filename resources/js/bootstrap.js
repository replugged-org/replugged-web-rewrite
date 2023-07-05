import Alpine from "alpinejs";
import Clipboard from "@ryangjchandler/alpine-clipboard";

// Provides $clipboard and x-clipboard
Alpine.plugin(Clipboard);

// Debug directive for logging any data managed by Alpine. Use as `x-log`.
Alpine.directive("log", (_, { expression }, { evaluate }) => {
    console.log(evaluate(expression));
});

Alpine.store("toasts", {
    counter: 0,
    list: [],
    createToast(message, type = "info") {
        const index = this.list.length;
        let totalVisible =
            this.list.filter((toast) => toast.visible).length + 1;
        this.list.push({
            id: this.counter++,
            message,
            type,
            visible: true,
        });
        setTimeout(() => this.destroyToast(index), 2000 * totalVisible);
    },
    destroyToast(index) {
        this.list[index].visible = false;
    },
});

window.Alpine = Alpine;
window.Alpine.start();

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
