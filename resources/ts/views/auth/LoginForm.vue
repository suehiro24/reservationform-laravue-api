<script setup lang="ts">
import { useAuthUserStore } from '@/plugins/stores/auth-user'
import { reactive, ref } from 'vue'

const valid = ref(true)

const inputs = reactive({
  email: {
    value: '',
    label: 'メールアドレス',
    rules: [
      (v: string) => !!v || 'メールアドレスを入力してください',
      (v: string) =>
        /.+@.+\..+/.test(v) || '有効なメールアドレスを入力してください',
    ],
  },
  password: {
    value: '',
    counter: 15,
    label: 'パスワード',
    rules: [(v: string) => !!v || 'パスワードを入力してください'],
  },
  remember: true,
})

const { login } = useAuthUserStore()

const execLogin = async () => {
  const payload = {
    email: inputs.email.value,
    password: inputs.password.value,
    remember: inputs.remember,
  }
  await login(payload)
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
</template>
