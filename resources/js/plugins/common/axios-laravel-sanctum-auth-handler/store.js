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
  logout ({ commit, dispatch }) {
    return authService.logout()
      .then(() => {
        dispatch('clearUser')
        dispatch('flashMsg/pushSuccessMessage', 'ログアウトしました。', { root: true })
        router.push({ path: '/login' })
      })
      .catch((e) => {
        dispatch('flashMsg/pushErrorMessage', 'ログアウトが失敗しました。もう一度お試しください。', { root: true })
      })
  },
  login ({ commit, dispatch }, payload) {
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
          dispatch('flashMsg/pushErrorMessage', 'メール認証が行われていないためログインできません。', { root: true })
          return
        }

        dispatch('setUser', authUser)
        router.push('/management')
      })
      .catch((e) => {
        dispatch('flashMsg/pushErrorMessage', 'ログインが失敗しました。もう一度お試しください。', { root: true })
        dispatch('clearUser')
      })
  },
  register ({ commit, dispatch }, payload) {
    return authService.registerUser(payload)
      .then(async response => {
        dispatch('flashMsg/pushSuccessMessage', 'ユーザ登録が成功しました。', { root: true })
        await dispatch('login', payload)
      })
      .catch((e) => {
        dispatch('flashMsg/pushErrorMessage', 'ユーザ登録が失敗しました。もう一度お試しください。', { root: true })
      })
  },
  forgotPassword ({ commit, dispatch }, payload) {
    return authService.forgotPassword(payload)
      .then(async response => {
        dispatch('flashMsg/pushSuccessMessage', 'パスワードリセット用メールを送信しました。', { root: true })
      })
      .catch((e) => {
        dispatch('flashMsg/pushErrorMessage', 'パスワードリセット用メールの送信が失敗しました。もう一度お試しください。', { root: true })
      })
  },
  resetPassword ({ commit, dispatch }, payload) {
    return authService.resetPassword(payload)
      .then(async response => {
        dispatch('flashMsg/pushSuccessMessage', 'パスワードのリセットが成功しました。', { root: true })
        await dispatch('login', payload)
      })
      .catch((e) => {
        dispatch('flashMsg/pushErrorMessage', 'パスワードのリセットが失敗しました。もう一度お試しください。', { root: true })
      })
  },
  getAuthUser ({ commit, dispatch }) {
    return authService.getAuthUser()
      .then(response => {
        const authUser = response.data.authUser
        dispatch('setUser', authUser)
        return authUser
      })
      .catch((e) => {
        dispatch('clearUser')
        return null
      })
  },
  setUser ({ commit }, authUser) {
    console.log('setUser: ', authUser)
    commit('setUser', authUser)
  },
  clearUser ({ commit }) {
    console.log('setUser: ', null)
    commit('setUser', null)
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
