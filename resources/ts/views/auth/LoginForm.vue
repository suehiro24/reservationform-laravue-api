<script setup lang="ts">
import { useAuth } from '@/composition/auth'
import { useAuthFormInputs } from '@/composition/authFormInputs'
import { ref } from 'vue'
import type { VForm } from 'vuetify/components'

const { login } = useAuth()
const { valid, inputs } = useAuthFormInputs()

const form = ref<VForm | null>(null)

const validate = async () => {
  return await form.value?.validate()
}

const execLogin = async () => {
  const result = await validate()
  if (!result?.valid) return

  const payload = {
    email: inputs.email.value,
    password: inputs.password.value,
    remember: inputs.remember,
  }
  await login(payload)
}
</script>

<template>
  <div>
    <VCard max-width="600px" class="mx-auto">
      <VCardText>
        <VForm ref="form" v-model="valid" lazy-validation>
          <VTextField
            v-model="inputs.email.value"
            :rules="inputs.email.rules"
            :label="inputs.email.label"
            type="email"
            required
          ></VTextField>

          <VTextField
            v-model="inputs.password.value"
            :counter="inputs.password.counter"
            :rules="inputs.password.rules"
            :label="inputs.password.label"
            type="password"
            required
          ></VTextField>

          <VRow class="mt-0">
            <VCheckbox
              v-model="inputs.remember"
              color="primary"
              label="remember"
              hide-details
            />
            <VCol cols="auto">
              <VBtn color="primary" to="/forgot-password">
                パスワードを忘れた場合
              </VBtn>
              <VBtn d="!valid" class="ml-5" color="primary" @click="execLogin">
                ログイン
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>

    <VSheet max-width="600px" class="mt-3 mx-auto">
      <VRow>
        <VSpacer />
        <VCol cols="auto">
          <RouterLink to="/register" class="text-right">
            <VBtn variant="tonal" color="primary">新規登録</VBtn>
          </RouterLink>
        </VCol>
      </VRow>
    </VSheet>
  </div>
</template>
