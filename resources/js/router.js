import { createRouter, createWebHistory } from 'vue-router';
import Reservation from "@/components/reservation/Reservation.vue";
import Management from "@/components/management/Management.vue";

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: Reservation },
    { path: '/management', component: Management },
  ],
});
