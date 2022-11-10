<script setup lang="ts">
import { useAuth } from '@/composition/auth'
import LogoutBtn from './auth/LogoutBtn.vue'

const { authenticated, logout } = useAuth()
</script>

<template>
  <VToolbar>
    <!-- <VAppBarNavIcon></VAppBarNavIcon> -->
    <VToolbarTitle>予約フォーム</VToolbarTitle>
    <VSpacer />
    <VBtn variant="text" to="/">Home</VBtn>
    <VBtn variant="text" to="/about" class="mx-5">About</VBtn>
    <LogoutBtn v-if="authenticated" @click="logout" />
  </VToolbar>
</template>
