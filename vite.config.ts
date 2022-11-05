import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import vuetify from 'vite-plugin-vuetify'

export default defineConfig({
  plugins: [
    laravel(['resources/css/app.css', 'resources/ts/app.ts']),
    vue(),
    vueJsx(),
    // https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vite-plugin
    vuetify({
      autoImport: true,
    }),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./resources/ts', import.meta.url)),
    },
  },
})
