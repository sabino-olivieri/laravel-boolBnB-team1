import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    base: '/build/',
    // Add resolve object and aliases
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "~@fortawesome": path.resolve(__dirname, "node_modules/@fortawesome"),
            "~resources": "/resources/",
            'jquery': path.resolve(__dirname, 'node_modules/jquery'),
        },
    },
    build: {
        outDir: 'public/build',
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (/\.woff2?$|\.ttf$|\.eot$|\.svg$/.test(assetInfo.name)) {
                        return 'webfonts/[name][extname]'; // Font files go to 'webfonts'
                    }
                    return 'assets/[name][extname]'; // Default for other assets
                },
            },
        },
    }
});
