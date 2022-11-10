<script setup lang="ts">
import { useAuth } from '@/composition/auth'
import { reactive, ref } from 'vue'
import { VForm } from 'vuetify/components'

const { register } = useAuth()

const valid = ref(true)

const form = ref<VForm | null>(null)

const inputs = reactive({
  name: {
    value: '',
    counter: 10,
    label: '氏名',
    rules: [
      (v: string) => !!v || '氏名は入力必須です',
      (v: string) =>
        (v && v.length <= 10) || '氏名は10文字以内で入力してください',
    ],
  },
  email: {
    value: '',
    label: 'メールアドレス',
    rules: [
      (v: string) => !!v || 'メールアドレスは入力必須です',
      (v: string) =>
        /.+@.+\..+/.test(v) || '有効なメールアドレスを入力してください',
    ],
  },
  password: {
    value: '',
    counter: 15,
    label: 'パスワード',
    rules: [
      (v: string) => !!v || 'パスワードは入力必須です',
      (v: string) =>
        (v && v.length <= 15) || 'パスワードは15文字以内で入力してください',
      (v: string) =>
        /(?=.*[.!"#$%&'()*+\-.,/:;<=>?@[\\\]^_`{|}~])[a-zA-Z0-9.!"#$%&'()*+\-.,/:;<=>?@[\\\]^_`{|}~]{8,15}/.test(
          v
        ) || '記号を含む半角英数字で8～15文字のパスワードを入力してください',
    ],
  },
  passwordConf: {
    value: '',
    label: 'パスワード(確認用)',
    rules: [(v: string) => !!v || 'パスワードは入力必須です'],
  },
  // admin: {
  //   value: false,
  //   label: '管理者',
  //   rules: [
  //     v => !!v || '入力を行ってください',
  //   ],
  // },
})

const execRegister = async () => {
  const result = await validate()
  if (!result?.valid) return

  const payload = {
    name: inputs.name.value,
    email: inputs.email.value,
    password: inputs.password.value,
    password_confirmation: inputs.passwordConf.value,
  }
  await register(payload)
}

const validate = async () => {
  return await form.value?.validate()
}

const passwordConfRule = (v: string) => {
  return v === inputs.password.value || '確認用パスワードが一致していません'
}
</script>

<template>
  <VCard max-width="600px" class="mx-auto">
    <VCardText>
      <VForm ref="form" v-model="valid" lazy-validation>
        <VTextField
          v-model="inputs.name.value"
          :counter="inputs.name.counter"
          :rules="inputs.name.rules"
          :label="inputs.name.label"
          required
        ></VTextField>

        <VTextField
          v-model="inputs.email.value"
          :rules="inputs.email.rules"
          :label="inputs.email.label"
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

        <VTextField
          v-model="inputs.passwordConf.value"
          :counter="inputs.password.counter"
          :rules="[...inputs.passwordConf.rules, passwordConfRule]"
          :label="inputs.passwordConf.label"
          type="password"
          required
        ></VTextField>

        <!--
          <v-checkbox
          v-model="inputs.admin.value"
          :rules="inputs.admin.rules"
          :label="inputs.admin.lavel"
          required
          ></v-checkbox>
        -->

        <VRow class="mt-0">
          <v-spacer />
          <VCol justify="end" cols="auto">
            <VBtn :disabled="!valid" color="primary" @click="execRegister">
              登録
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCardText>
  </VCard>
</template>

<style></style>
