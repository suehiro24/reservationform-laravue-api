<script setup lang="ts">
import { useFlashMsgStore } from '@/plugins/stores/flash-message-store'
import { storeToRefs } from 'pinia'

const flashMsgStore = useFlashMsgStore()
const { messages } = storeToRefs(flashMsgStore)
const { removeMessage } = flashMsgStore

const getTimeOut = (color: string) => {
  return color === 'success' ? 5000 : -1
}
</script>

<template>
  <VSnackbar
    v-for="flashMsg in messages"
    :key="flashMsg.key"
    :timeout="getTimeOut(flashMsg.color)"
    :color="flashMsg.color"
    :model-value="true"
    absolute
    bottom
  >
    {{ flashMsg.message }}
    <template #actions>
      <VBtn text @click="removeMessage(flashMsg.key)">close</VBtn>
    </template>
  </VSnackbar>
</template>

<style scoped></style>
