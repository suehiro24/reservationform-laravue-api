const enableAxiosLogger = (axios) => {
  axios.interceptors.request.use(
    config => {
      console.log('[axios-logger] req', config.url, config.method)
      console.log('                     data   :', config.data)
      return config
    },
    error => {
      console.error('[axios-logger] req error :', error)
      return Promise.reject(error)
    },
  )

  axios.interceptors.response.use(
    config => {
      // リクエストキャンセル時
      if (!config) {
        console.log('[axios-logger] res config nothing', config)
        return config
      }
      // 通常時
      console.log('[axios-logger] res', config.config.url, config.status)
      console.log('                     data:', config.data)
      return config
    },
    error => {
      if (axios.isCancel(error)) {
        console.info('[axios-logger] res cancels :', error)
      } else {
        console.error('[axios-logger] res error :', error)
      }
      return Promise.reject(error)
    },
  )
}

export default enableAxiosLogger
