import Vue from 'vue'
import Vuex from 'vuex'

import loader from '@/plugins/common/axios-store-loading-setter/store'

Vue.use(Vuex)

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  modules: {
    loader,
  },
})

export default store
