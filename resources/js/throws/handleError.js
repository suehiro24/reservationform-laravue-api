import AbnormalResponseException from './AbnormalResponseException'

const handleError = (axios, store, error = null) => {
  // @see https://github.com/axios/axios/issues/383
  if (error && !error.code && error.message === 'Network Error') {
    console.error('network error')

    store.dispatch('flashMsg/pushErrorMessage', error.message)
    return
  }

  if (axios.isCancel(error)) {
    return
  }

  if (error instanceof AbnormalResponseException) {
    console.error('[Abnormal response!]\n', error)

    store.dispatch('flashMsg/pushErrorMessage', error.message)
    return
  }

  if (error) console.error(error)
}

export default handleError
