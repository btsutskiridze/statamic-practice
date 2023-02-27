import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel([
            "resources/css/web.css",
            "resources/js/site.js",
            "https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js",
            // "resources/sass/cp.scss",
            // "public/vendor/app/css",
        ]),
        vue({
            template: {
                compilerOptions: {
                    isCustomElement: (tag) => ["md-linedivider"].includes(tag),
                },
            },
        }),
    ],
});
