import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import { routes as authRoutes } from '@/plugins/router/routes/auth'
import { useAuth } from '@/composition/auth'
import { useFlashMsgStore } from '../stores/flash-message-store'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'About',
      meta: { requireAuth: true },
      component: () => import('@/views/AboutView.vue'),
    },
    ...authRoutes,
  ],
})

router.beforeEach(async (to, from, next) => {
  const { authenticated, fetchUser } = useAuth()
  const { pushErrorMessage } = useFlashMsgStore()
  const isAuthRequiredPath = to.matched.some(record => record.meta.requireAuth)

  if (isAuthRequiredPath && !authenticated.value) {
    const userReloaded = await fetchUser()

    if (!userReloaded) {
      pushErrorMessage('ログインが必要なページの表示をキャンセルしました')

      // Redirect
      next({
        path: '/login',
        query: { redirect: to.fullPath },
      })
      return
    }
  }

  // 要求されたページへの遷移
  next()
})

export default router
