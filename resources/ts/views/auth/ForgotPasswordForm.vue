<script setup lang="ts">
import { useAuthUserStore } from '@/plugins/stores/auth-user'
import { reactive, ref } from 'vue'
import { VForm } from 'vuetify/components'

const { forgotPassword } = useAuthUserStore()

const valid = ref(true)

const form = ref<VForm | null>(null)

const inputs = reactive({
  email: {
    value: '',
    label: 'メールアドレス',
    rules: [
      (v: string) => !!v || 'メールアドレスは入力必須です',
      (v: string) =>
        /.+@.+\..+/.test(v) || '有効なメールアドレスを入力してください',
    ],
  },
})

const execForgotPassword = async () => {
  if (!validate()) return

  const payload = {
    email: inputs.email.value,
  }
  await forgotPassword(payload)
}
const validate = async () => {
  return await form.value?.validate()
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
