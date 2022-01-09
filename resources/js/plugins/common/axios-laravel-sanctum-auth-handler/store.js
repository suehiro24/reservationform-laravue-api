// See: https://router.vuejs.org/guide/advanced/navigation-failures.html#detecting-navigation-failures
import VueRouter from 'vue-router'
const { isNavigationFailure, NavigationFailureType } = VueRouter

import router from '@/router'
import authService from '@/plugins/common/axios-laravel-sanctum-auth-handler/authService'

const modules = {
}

const state = {
  authUser: null,
}

const getters = {
  authUser: (state) => {
    return state.authUser
  },
  isLoggedIn: (state) => {
    return !!state.authUser
  },
}

const actions = {
  logout ({ commit }) {
    return authService.logout()
      .then(() => {
        commit('setUser', null)
        router.push({ path: '/login' })
      })
      .catch((e) => {
        // TODO: 画面用エラーメッセージ
        console.error(e)
      })
  },
  login ({ commit }, payload) {
    return authService.login(payload)
      .then(response => {
        const authUser = response.data.authUser

        if (!authUser.email_verified_at) {
          router.push('/login').catch(failure => {
            // 同ページの遷移エラー(NavigationDuplicatedError)は握りつぶす
            if (!isNavigationFailure(failure, NavigationFailureType.duplicated)) {
              throw failure
            }
          })
          // TODO: 画面用メール認証未済メッセージ
          console.error('メール認証未済')
          return
        }

        console.log('setUser: ', authUser)
        commit('setUser', authUser)
        router.push('/management')
      })
      .catch((e) => {
        // TODO: 画面用エラーメッセージ
        console.error(e)
        console.log('setUser: ', null)
        commit('setUser', null)
      })
  },
  register ({ commit, dispatch }, payload) {
    return authService.registerUser(payload)
      .then(async response => {
        await dispatch('login', payload)
      })
      .catch((e) => {
        // TODO: 画面用エラーメッセージ
        console.error(e)
      })
  },
  getAuthUser ({ commit }) {
    return authService.getAuthUser()
      .then(response => {
        const authUser = response.data.authUser
        console.log('setUser: ', authUser)
        commit('setUser', authUser)
        return authUser
      })
      .catch((e) => {
        // TODO: 画面用エラーメッセージ
        console.error(e)
        console.log('setUser: ', null)
        commit('setUser', null)
        return null
      })
  },
}

const mutations = {
  setUser (state, authUser) {
    state.authUser = authUser
  },
}

export default {
  namespaced: true,
  modules,
  state,
  getters,
  actions,
  mutations,
}
