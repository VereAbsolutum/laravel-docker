import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
            '/': {
                target: 'http://laravel.test:83', // Substitua pelo seu domínio Laravel
                changeOrigin: true,
                ws: true,
            },
        },
    },
});
