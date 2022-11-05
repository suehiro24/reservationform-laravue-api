export const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/views/auth/LoginForm.vue'),
  },
  // {
  //   path: '/register',
  //   name: 'Register',
  //   // meta: { requiresAuth: true },
  //   component: () => import('@/components/auth/Register'),
  // },
  // {
  //   path: '/reset-password',
  //   name: 'ResetPassword',
  //   component: () => import('@/components/auth/ResetPassword'),
  // },
  // {
  //   path: '/forgot-password',
  //   name: 'ForgotPassword',
  //   component: () => import('@/components/auth/ForgotPassword'),
  // },
]
