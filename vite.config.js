import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';      //  add the official Vue 2 plugin
import path from 'path';                   //  alias helper (optional but handy)

export default defineConfig({
    plugins: [
        laravel({
            // These files are injected into your Blade templates
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,                 // Enables hot reload on PHP + Blade changes
        }),
        vue(),                             // Activates Vue 2 single‑file‑component support
    ],

    // Clean “@/” imports (e.g. import Button from '@/components/Button.vue')
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
