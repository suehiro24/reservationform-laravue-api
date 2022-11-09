export const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/views/auth/LoginForm.vue'),
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('@/views/auth/RegisterForm.vue'),
  },
  {
    path: '/forgot-password',
    name: 'ForgotPassword',
    component: () => import('@/views/auth/ForgotPasswordForm.vue'),
  },
  // {
  //   path: '/forgot-password',
  //   name: 'ForgotPassword',
  //   component: () => import('@/components/auth/ForgotPassword'),
  // },
]
