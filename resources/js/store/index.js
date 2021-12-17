import Vue from 'vue'
import Vuex from 'vuex'

import loader from '@/store/modules/loader'

Vue.use(Vuex)

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  modules: {
    loader: loader,
  },
})

export default store
