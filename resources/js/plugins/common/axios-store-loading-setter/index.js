let loadingCounter = 0

const updateIsLoading = (store, setMutationType) => {
  const isLoading = loadingCounter > 0
  store.dispatch(setMutationType, isLoading)
}

const enableAxiosStoreLoadingSetter = (axios, store, setMutationType) => {
  axios.interceptors.request.use(
    config => {
      loadingCounter++
      updateIsLoading(store, setMutationType)

      return config
    },
    error => {
      loadingCounter--
      updateIsLoading(store, setMutationType)

      return Promise.reject(error)
    })

  axios.interceptors.response.use(
    response => {
      loadingCounter--
      updateIsLoading(store, setMutationType)

      return response
    },
    error => {
      loadingCounter--
      updateIsLoading(store, setMutationType)

      return Promise.reject(error)
    })
}

export default enableAxiosStoreLoadingSetter
