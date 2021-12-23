// 障害ではない業務制約または排他エラーレスポンス例外クラス.
class AbnormalResponseException extends Error {
  constructor (response) {
    super()

    this.name = 'AbnormalResponseException'
    this.message = response.data.abnormalContents.resultMessage
  }
}

export default AbnormalResponseException
