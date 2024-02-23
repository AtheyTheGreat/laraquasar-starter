import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'

import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue({
            template: { transformAssetUrls }
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        quasar({
            sassVariables: 'resources/js/quasar-variables.scss'
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
