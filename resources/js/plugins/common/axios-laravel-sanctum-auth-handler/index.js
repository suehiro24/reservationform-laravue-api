const enableAxiosLaravelSanctumAuthHandler = (axios, store, router) => {
  /**
   * Axios
   */
  axios.interceptors.response.use(
    response => {
      return response
    },
    error => {
      if (
        error.response &&
        (error.response.status === 401 || error.response.status === 419)
      ) {
        store.dispatch('auth/clearUser')
      }

      return Promise.reject(error)
    },
  )

  /**
   * Router
   */
  router.beforeEach(async (to, from, next) => {
    const authUser = store.getters['auth/authUser']
    const reqAuth = to.matched.some(record => record.meta.requiresAuth)
    const redirectToLoginWithRequiredPath = {
      path: '/login', query: { redirect: to.fullPath },
    }

    // 認証が必要なページへの遷移要求 && 未認証状態
    if (reqAuth && !authUser) {
      // 認証ユーザ再取得
      const authUserReloaded = await store.dispatch('auth/getAuthUser')
      if (!authUserReloaded) {
        store.dispatch('flashMsg/pushErrorMessage', 'ログインが必要なページの表示をキャンセルしました')
        // ログイン画面にリダイレクト
        next(redirectToLoginWithRequiredPath)
      }
    }

    // 要求されたページへの遷移
    next()
  })
}

export default enableAxiosLaravelSanctumAuthHandler
