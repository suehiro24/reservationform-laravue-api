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
import { useFlashMsgStore } from './flash-message-store'

export const useAuthUserStore = defineStore('auth-user', () => {
  const { pushSuccessMessage, pushErrorMessage } = useFlashMsgStore()

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
        pushSuccessMessage('ユーザ登録が成功しました。')
        return { success: true }
      })
      .catch(e => {
        pushErrorMessage('ユーザ登録が失敗しました。もう一度お試しください。')
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
          pushErrorMessage('メール認証が行われていないためログインできません。')
          return null
        }

        setUser(authUser)
        return authUser
      })
      .catch(e => {
        clearUser()
        pushErrorMessage('ログインが失敗しました。もう一度お試しください。')
        return null
      })
  }

  const logout = () => {
    return AuthService.logout()
      .then(() => {
        clearUser()
        pushSuccessMessage('ログアウトしました。')
        return { success: true }
      })
      .catch(e => {
        pushErrorMessage('ログアウトが失敗しました。もう一度お試しください。')
        return { success: false }
      })
  }

  const forgotPassword = (payload: ForgotPassPayload) => {
    return AuthService.forgotPassword(payload)
      .then(() => {
        pushSuccessMessage('パスワードリセット用メールを送信しました。')
        return { success: true }
      })
      .catch(e => {
        pushErrorMessage(
          'パスワードリセット用メールの送信が失敗しました。もう一度お試しください。'
        )
        return { success: false }
      })
  }

  const resetPassword = async (payload: ResetPassPayload) => {
    return AuthService.resetPassword(payload)
      .then(async () => {
        pushSuccessMessage('パスワードのリセットが成功しました。')
        return { success: true }
      })
      .catch(e => {
        pushErrorMessage(
          'パスワードのリセットが失敗しました。もう一度お試しください。'
        )
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
