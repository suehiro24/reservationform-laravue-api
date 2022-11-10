import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import {
  AuthService,
  AuthUser,
  type ForgotPassPayload,
  type LoginPayload,
  type RegisterPayload,
  type ResetPassPayload,
} from '@/lib/api/auth-service'

export const useAuthUserStore = defineStore('auth-user', () => {
  //-------------
  // states
  //-------------
  const user = ref<AuthUser | null>(null)

  //-------------
  // getters
  //-------------
  const authenticated = computed(() => !!user.value)

  //-------------
  // actions
  //-------------
  const setUser = (authUser: AuthUser) => {
    user.value = authUser
  }

  const clearUser = () => {
    user.value = null
  }

  const fetchUser = async function () {
    const authUser = await AuthService.fetchUser()
    user.value = authUser
    return authUser
  }

  const register = async (payload: RegisterPayload) => {
    return AuthService.register(payload)
      .then(() => {
        // TODO: Flash message instead of console log
        // dispatch('flashMsg/pushSuccessMessage', 'ユーザ登録が成功しました。', {
        //   root: true,
        // })
        console.log('Registration Success')
        return { success: true }
      })
      .catch(e => {
        // TODO: Flash message instead of console log
        // dispatch(
        //   'flashMsg/pushErrorMessage',
        //   'ユーザ登録が失敗しました。もう一度お試しください。',
        //   { root: true }
        // )
        console.error('Registration Failure')
        return { success: false }
      })
  }

  const login = async (payload: LoginPayload): Promise<AuthUser | null> => {
    return AuthService.login(payload)
      .then(authUser => {
        if (!authUser) {
          console.error(
            '[Assertion] Login succeeded, but could not get authenticated user'
          )
          return null
        }

        if (!authUser.email_verified_at) {
          // TODO: Flash message instead of error log
          // dispatch('flashMsg/pushErrorMessage', 'メール認証が行われていないためログインできません。', { root: true })
          console.error('Email has not been verified')
          return null
        }

        setUser(authUser)
        return authUser
      })
      .catch(e => {
        // TODO: Flash message instead of console log
        // dispatch('flashMsg/pushErrorMessage', 'ログインが失敗しました。もう一度お試しください。', { root: true })
        console.error('Login Failure', e)
        clearUser()
        return null
      })
  }

  const logout = () => {
    return AuthService.logout()
      .then(() => {
        // TODO: Flash message instead of console log
        // dispatch('flashMsg/pushSuccessMessage', 'パスワードリセット用メールを送信しました。', { root: true })
        console.log('Logout succeed')
        clearUser()
        return { success: true }
      })
      .catch(e => {
        console.log('Logout failure', e)
        return { success: false }
      })
  }

  const forgotPassword = (payload: ForgotPassPayload) => {
    return AuthService.forgotPassword(payload)
      .then(() => {
        // TODO: Flash message instead of console log
        // dispatch('flashMsg/pushSuccessMessage', 'パスワードリセット用メールを送信しました。', { root: true })
        console.log('Reset password email has been successfully sent')
        return { success: true }
      })
      .catch(e => {
        // TODO: Flash message instead of console log
        // dispatch('flashMsg/pushErrorMessage', 'パスワードリセット用メールの送信が失敗しました。もう一度お試しください。', { root: true })
        console.error('Failed to send email to reset password')
        return { success: false }
      })
  }

  const resetPassword = async (payload: ResetPassPayload) => {
    return AuthService.resetPassword(payload)
      .then(async () => {
        // TODO: Flash message instead of console log
        // dispatch('flashMsg/pushSuccessMessage', 'パスワードのリセットが成功しました。', { root: true })
        console.log('Reset password Success')
        return { success: true }
      })
      .catch(e => {
        // TODO: Flash message instead of console log
        // dispatch(
        //   'flashMsg/pushErrorMessage',
        //   'パスワードのリセットが失敗しました。もう一度お試しください。',
        //   { root: true }
        // )
        console.error('Reset password Failure', e)
        return { success: false }
      })
  }

  return {
    //-------------
    // states
    //-------------
    user,
    //-------------
    // getters
    //-------------
    authenticated,
    //-------------
    // actions
    //-------------
    fetchUser,
    register,
    login,
    logout,
    forgotPassword,
    resetPassword,
  }
})
