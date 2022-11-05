import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineConfig({
  plugins: [
    laravel(['resources/css/app.css', 'resources/ts/app.ts']),
    vue(),
    vueJsx(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./resources/ts', import.meta.url)),
    },
  },
})
