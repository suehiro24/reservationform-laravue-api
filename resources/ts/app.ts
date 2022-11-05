import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from '@/App.vue'
import router from '@/plugins/router'

import '@/assets/base.css'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
