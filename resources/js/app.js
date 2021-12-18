require('@/bootstrap')

import Vue from 'vue'
import App from '@/components/App.vue'
import router from '@/router'
import store from '@/store'
import vuetify from '@/plugins/vuetify'

// import VueCompositionAPI from '@vue/composition-api'
// Vue.use(VueCompositionAPI)

/**
 * Plugins
 */
// ロード中フラグ管理
import enableAxiosStoreLoadingSetter from '@/plugins/common/axios-store-loading-setter'
enableAxiosStoreLoadingSetter(axios, store)
// ユーザメッセージ可能な例外のハンドリング
import enableAxiosAbnormalResponseHandler from '@/plugins/common/axios-abnormal-response-handler'
enableAxiosAbnormalResponseHandler(axios, AbnormalResponseException)

/**
 * Vue API
 */
Vue.config.productionTip = process.env.NODE_ENV !== 'development'
Vue.config.silent = process.env.NODE_ENV !== 'development'
// Error Handling
import handleError from '@/throws/handleError'
import AbnormalResponseException from '@/throws/AbnormalResponseException'
Vue.config.errorHandler = (error, vm, info) => {
  handleError(axios, store, error)
}
router.onError(error => {
  handleError(axios, store, error)
})


/**
 * Vue Instance Creation
 */
/* eslint-disable vue/require-name-property */
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
}).$mount('#app')
