import axios from '@/lib/axios'

export class AuthUser {
  constructor(
    public readonly name: UserName,
    public readonly email: Email,
    public readonly email_verified_at: string
  ) {}
}

type Email = string
type UserName = string
type Password = string

type AuthPayloadBase = {
  email: Email
  password: Password
}

export type LoginPayload = AuthPayloadBase & {
  remember: boolean
}

export type ForgotPassPayload = {
  email: Email
}

export type ResetPassPayload = AuthPayloadBase & {
  password_confirmation: Password
  token: string
}

export type RegisterPayload = AuthPayloadBase & {
  name: UserName
  password_confirmation: Password
}

const csrf = async () => axios.get('/sanctum/csrf-cookie')

const fetchUser = async () => {
  try {
    const res = await axios.get<{ authUser: AuthUser }>('/api/user/auth')
    return res.data.authUser
  } catch (e) {
    if (axios.isAxiosError(e) && e.response?.status === 401) {
      return null
    }
    throw e
  }
}

const register = async (payload: RegisterPayload) => {
  await csrf()
  await axios.post('/register', payload)
}
const login = async (payload: LoginPayload) => {
  try {
    await axios.post('/login', payload)
    return await fetchUser()
  } catch (error) {
    return null
  }
}
const logout = async () => {
  await axios.post('/logout')
}
const forgotPassword = async (payload: ForgotPassPayload) => {
  await csrf()
  await axios.post('/forgot-password', payload)
}
const resetPassword = async (payload: ResetPassPayload) => {
  await csrf()
  await axios.post('/reset-password', payload)
}

// async sendVerification(payload) {
//   await axios.post('/email/verification-notification', payload)
// },

export const AuthService = {
  fetchUser,
  register,
  login,
  logout,
  forgotPassword,
  resetPassword,
}
