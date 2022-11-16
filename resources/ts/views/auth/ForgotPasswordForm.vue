<script setup lang="ts">
import { useAuth } from '@/composition/auth'
import { useAuthFormInputs } from '@/composition/authFormInputs'
import { ref } from 'vue'
import type { VForm } from 'vuetify/components'

const { forgotPassword } = useAuth()
const { valid, inputs } = useAuthFormInputs()

const form = ref<VForm | null>(null)

const validate = async () => {
  return await form.value?.validate()
}

const execForgotPassword = async () => {
  const result = await validate()
  if (!result?.valid) return

  const payload = {
    email: inputs.email.value,
  }
  await forgotPassword(payload)
}
</script>

<template>
  <VCard max-width="600px" class="mx-auto">
    <VCardText>
      <VForm ref="form" v-model="valid" lazy-validation>
        <VTextField
          v-model="inputs.email.value"
          :rules="inputs.email.rules"
          :label="inputs.email.label"
          required
        ></VTextField>

        <VRow class="mt-0">
          <VSpacer />
          <VCol justify="end" cols="auto">
            <VBtn
              :disabled="!valid"
              color="primary"
              @click="execForgotPassword"
            >
              パスワードリセット用メールを送る
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCardText>
  </VCard>
</template>
