<script setup lang="ts">
import { useAuth } from '@/composition/auth'
import { useAuthFormInputs } from '@/composition/authFormInputs'
import { ref } from 'vue'
import type { VForm } from 'vuetify/components'

const { register } = useAuth()
const { valid, inputs } = useAuthFormInputs()

const form = ref<VForm | null>(null)

const validate = async () => {
  return await form.value?.validate()
}

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
          :rules="inputs.passwordConf.rules"
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
