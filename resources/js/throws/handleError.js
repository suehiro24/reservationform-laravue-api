import AbnormalResponseException from './AbnormalResponseException'

const handleError = (axios, store, error = null) => {
  // @see https://github.com/axios/axios/issues/383
  if (error && !error.code && error.message === 'Network Error') {
    console.error('network error')

    store.dispatch('flashMsg/pushMessage', error.message)
    store.dispatch('flashMsg/flash')
    return
  }

  // // 認証切れ。画面更新し、ログイン画面出す
  // if (error && error.response && error.response.status === 401) {
  //   window.location.reload(true)
  //   return
  // }

  if (axios.isCancel(error)) {
    return
  }

  if (error instanceof AbnormalResponseException) {
    console.error('[Abnormal response!]\n', error)

    store.dispatch('flashMsg/pushMessage', error.message)
    store.dispatch('flashMsg/flash')
    return
  }

  if (error) console.error(error)
}

export default handleError
