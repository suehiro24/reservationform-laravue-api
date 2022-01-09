export default {
  async login (payload) {
    await axios.get('/sanctum/csrf-cookie')
    return await axios.post('/login', payload)
  },
  async logout () {
    await axios.post('/logout')
  },
  async forgotPassword (payload) {
    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/forgot-password', payload)
  },
  async getAuthUser () {
    return await axios.get('/api/user/auth')
  },
  async resetPassword (payload) {
    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/reset-password', payload)
  },
  async registerUser (payload) {
    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/register', payload)
  },
  async sendVerification (payload) {
    await axios.post('/email/verification-notification', payload)
  },
}
