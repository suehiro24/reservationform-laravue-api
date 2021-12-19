const enableAxiosStoreLoadingSetter = (axios, store) => {
  axios.interceptors.request.use(
    config => {
      store.dispatch('loader/increment')

      return config
    },
    error => {
      store.dispatch('loader/decrement')

      return Promise.reject(error)
    })

  axios.interceptors.response.use(
    response => {
      store.dispatch('loader/decrement')

      return response
    },
    error => {
      store.dispatch('loader/decrement')

      return Promise.reject(error)
    })
}

export default enableAxiosStoreLoadingSetter
