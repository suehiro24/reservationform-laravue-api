import Vue from 'vue'
import Vuex from 'vuex'

import auth from '@/plugins/common/axios-laravel-sanctum-auth-handler/store'
import loader from '@/plugins/common/axios-store-loading-setter/store'
import flashMsg from '@/store/modules/flashMsg'

Vue.use(Vuex)

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== 'production',
  modules: {
    auth,
    loader,
    flashMsg,
  },
})

export default store
