<script setup lang="ts">
import { RouterLink } from 'vue-router'
</script>

<template>
  <VToolbar>
    <!-- <VAppBarNavIcon></VAppBarNavIcon> -->
    <VToolbarTitle>予約フォーム</VToolbarTitle>
    <VSpacer />
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/about" class="mx-5">About</RouterLink>
  </VToolbar>
</template>
