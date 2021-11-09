require('@/bootstrap')

import Vue from 'vue'
import App from '@/components/App.vue'
import router from '@/router'
// import store from '@/store'
import vuetify from '@/vuetify'

// import VueCompositionAPI from '@vue/composition-api'
// Vue.use(VueCompositionAPI)

// Vue.config.productionTip = false

new Vue({
  router,
  // store,
  vuetify,
  render: h => h(App),
}).$mount('#app')
