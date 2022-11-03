import type { AxiosStatic } from 'axios'

const useAxiosLogger = (axios: AxiosStatic) => {
  axios.interceptors.request.use(
    config => {
      console.log('[axios req]', config.url, config.method)
      console.log('                     data   :', config.data)
      return config
    },
    error => {
      console.error('[axios req] error :', error)
      return Promise.reject(error)
    }
  )

  axios.interceptors.response.use(
    config => {
      // リクエストキャンセル時
      if (!config) {
        console.log('[axios res] config none: ', config)
        return config
      }
      // 通常時
      console.log('[axios res]', config.config.url, config.status)
      console.log('                     data:', config.data)
      return config
    },
    error => {
      if (axios.isCancel(error)) {
        console.error('[axios res] canceled : ', error)
      } else {
        console.error('[axios res] error : ', error)
      }
      return Promise.reject(error)
    }
  )
}

export default useAxiosLogger
