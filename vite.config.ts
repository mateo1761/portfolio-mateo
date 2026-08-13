import { existsSync, readFileSync } from 'node:fs';
import { resolve } from 'node:path';
import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import { defineConfig } from 'vite';

const certificatePath = resolve('docker/nginx/certs/portfolio-mateo.test.pem');
const certificateKeyPath = resolve(
    'docker/nginx/certs/portfolio-mateo.test-key.pem',
);
const hasLocalCertificate =
    existsSync(certificatePath) && existsSync(certificateKeyPath);

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: Number(process.env.VITE_PORT ?? 5173),
        strictPort: true,
        origin: hasLocalCertificate
            ? 'https://portfolio-mateo.test:5173'
            : undefined,
        cors: {
            origin: [
                'https://portfolio-mateo.test',
                'http://localhost:8080',
            ],
        },
        hmr: {
            host: process.env.VITE_HMR_HOST ?? 'portfolio-mateo.test',
            protocol: hasLocalCertificate ? 'wss' : 'ws',
        },
        https: hasLocalCertificate
            ? {
                  cert: readFileSync(certificatePath),
                  key: readFileSync(certificateKeyPath),
              }
            : undefined,
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        inertia(),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        wayfinder({
            formVariants: true,
            command:
                process.env.WAYFINDER_SKIP_GENERATION === '1'
                    ? 'true'
                    : undefined,
        }),
    ],
});
