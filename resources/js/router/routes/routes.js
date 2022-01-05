const routes = [
  {
    path: '/',
    name: 'Reservation',
    component: () => import('@/components/reservation/Reservation.vue'),
  },
  {
    path: '/management',
    name: 'Management',
    meta: { requiresAuth: true },
    component: () => import('@/components/management/Management.vue'),
  },

  /**
   * Auth
   */
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/components/auth/Login'),
  },
  {
    path: '/register',
    name: 'Register',
    // meta: { requiresAuth: true },
    component: () => import('@/components/auth/Register'),
  },
  {
    path: '/reset-password',
    name: 'ResetPassword',
    component: () => import('@/components/auth/ResetPassword'),
  },
  {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: () => import('@/components/auth/ForgotPassword'),
  },
]

export default routes
