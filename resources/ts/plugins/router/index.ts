import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import { routes as authRoutes } from '@/plugins/router/routes/auth'
import { useAuth } from '@/composition/auth'

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
  const isAuthRequiredPath = to.matched.some(record => record.meta.requireAuth)

  if (isAuthRequiredPath && !authenticated.value) {
    const userReloaded = await fetchUser()

    if (!userReloaded) {
      // TODO: Implement store for messaging
      // store.dispatch(
      //   'flashMsg/pushErrorMessage',
      //   'ログインが必要なページの表示をキャンセルしました'
      // )

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
