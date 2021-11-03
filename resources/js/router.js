import Vue from 'vue'
import VueRouter from 'vue-router'

import Reservation from "@/components/reservation/Reservation.vue";
import Management from "@/components/management/Management.vue";

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    { path: '/', component: Reservation },
    { path: '/management', component: Management },
  ],
})

export default router
