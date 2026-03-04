import { defineConfig } from 'vite';

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 5173,
  },
  publicDir: false,
  build: {
    outDir: 'public/build',
    manifest: true,
    rollupOptions: {
      input: ['resources/css/app.css', 'resources/js/app.js'],
    },
  },
});
