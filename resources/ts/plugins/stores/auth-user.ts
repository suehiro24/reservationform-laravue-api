import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { AuthService, type AuthUser } from '@/lib/api/auth-service'

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
  const fetchUser = async function () {
    const authUser = await AuthService.fetchUser()
    user.value = authUser
    return authUser
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
    register: AuthService.register,
    login: AuthService.login,
    logout: AuthService.logout,
    forgotPassword: AuthService.forgotPassword,
    resetPassword: AuthService.resetPassword,
  }
})
