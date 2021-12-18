import AbnormalResponseException from './AbnormalResponseException'

const treatResponse = (response) => {
  if (!response.data) return response
  if (!response.data.header) return response

  if (response.data.header.result_code !== 0) {
    // 障害ではない業務制約または排他エラーレスポンスなら例外投げる
    throw new AbnormalResponseException(response)
  }

  return response
}

export default treatResponse
