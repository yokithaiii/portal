import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            vue: 'node_modules/vue/dist/vue.esm-bundler.js',
        }
    },
});