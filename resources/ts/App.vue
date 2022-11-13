<script setup lang="ts">
import { RouterView } from 'vue-router'
import VHeader from '@/components/VHeader.vue'
import FlashMsgSnackbar from './components/flash-message/FlashMsgSnackbar.vue'
</script>

<template>
  <VContainer>
    <VHeader />

    <VContainer fluid class="py-10">
      <RouterView />
    </VContainer>

    <FlashMsgSnackbar />
  </VContainer>
</template>
