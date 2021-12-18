import treateResponse from './treateResponse'
import handleError from './handleError'

const enableAxiosAbnormalErrorHandler = (axios, store) => {
  axios.interceptors.response.use(
    response => {
      treateResponse(response)

      return response
    },
    error => {
      handleError(axios, store, error)

      return Promise.reject(error)
    },
  )
}

export default enableAxiosAbnormalErrorHandler

