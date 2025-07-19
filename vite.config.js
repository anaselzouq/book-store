import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js','resources/js/main.js', 'resources/sass/app.scss', 'resources/sass/style.scss'],
            refresh: true,
        }),
    ],
});

