require('@/bootstrap')

import Vue from 'vue'
import App from '@/components/App.vue'
import router from '@/router'
import store from '@/store'
import vuetify from '@/plugins/vuetify'

import enableAxiosStoreLoadingSetter from '@/plugins/common/axios-store-loading-setter'
enableAxiosStoreLoadingSetter(axios, store)

// import VueCompositionAPI from '@vue/composition-api'
// Vue.use(VueCompositionAPI)

Vue.config.productionTip = process.env.NODE_ENV !== 'development'
Vue.config.silent = process.env.NODE_ENV !== 'development'

/* eslint-disable vue/require-name-property */
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
}).$mount('#app')
