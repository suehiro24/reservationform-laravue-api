import type {
  LoginPayload,
  RegisterPayload,
  ResetPassPayload,
} from '@/lib/api/auth-service'
import { useAuthUserStore } from '@/plugins/stores/auth-user-store'
import { storeToRefs } from 'pinia'
import {
  isNavigationFailure,
  NavigationFailureType,
  useRouter,
} from 'vue-router'

export const useAuth = () => {
  const router = useRouter()

  const authUserStore = useAuthUserStore()
  const { user, authenticated } = storeToRefs(authUserStore)
  const { fetchUser, register, login, logout, forgotPassword, resetPassword } =
    authUserStore

  const registerThenLogin = async (payload: RegisterPayload) => {
    const { success } = await register(payload)
    if (!success) return
    await loginThenRoute({ ...payload, remember: true })
  }

  const loginThenRoute = async (payload: LoginPayload) => {
    const authUser = await login(payload)

    if (authUser) {
      // TODO: push to /management
      router.push('/about')
    } else {
      router.push('/login').catch(e => {
        // 同ページの遷移エラー(NavigationDuplicatedError)は握りつぶす
        if (!isNavigationFailure(e, NavigationFailureType.duplicated)) {
          throw e
        }
      })
    }
  }

  const logoutThenRoute = async () => {
    const { success } = await logout()

    if (success) {
      router.push('/login')
    }
  }

  const resetPasswordThenLogin = async (payload: ResetPassPayload) => {
    const { success } = await resetPassword(payload)
    if (!success) return
    const { token, ...payloadWithoutToken } = payload
    await login({ ...payloadWithoutToken, remember: true })
  }

  return {
    user,
    authenticated,
    fetchUser,
    register: registerThenLogin,
    login: loginThenRoute,
    logout: logoutThenRoute,
    forgotPassword,
    resetPassword: resetPasswordThenLogin,
  }
}
