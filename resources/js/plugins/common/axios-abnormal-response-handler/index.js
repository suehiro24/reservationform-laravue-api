const enableAxiosAbnormalResponseHandler = (axios, abnormalResponseExceptionClass) => {
  axios.interceptors.response.use(
    response => {
      if (!response.data || !response.data.abnormalContents) return response

      // resultCode設定済みのレスポンスは画面表示可能な例外とする
      if (response.data.abnormalContents) {
        throw new abnormalResponseExceptionClass(response)
      }

      return response
    },
    error => Promise.reject(error),
  )
}

export default enableAxiosAbnormalResponseHandler

