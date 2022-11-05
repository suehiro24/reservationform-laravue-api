import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from '@/App.vue'
import router from '@/plugins/router'
import vuetify from '@/plugins/vuetify'

import { loadFonts } from './plugins/webfontloader'
loadFonts()

import '@/assets/base.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(vuetify)

app.mount('#app')
