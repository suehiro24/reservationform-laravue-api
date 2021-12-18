import Vue from 'vue'
import Vuex from 'vuex'

import loader from '@/plugins/common/axios-store-loading-setter/store'
import errorHandler from '@/plugins/common/axios-abnormal-error-handler/store'

Vue.use(Vuex)

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  modules: {
    loader,
    errorHandler,
  },
})

export default store
