<script setup lang="ts">
import { useAuth } from '@/composition/auth'
import { useAuthFormInputs } from '@/composition/authFormInputs'
import { ref } from 'vue'
import { useRoute } from 'vue-router'
import type { VForm } from 'vuetify/components'

const route = useRoute()

const { resetPassword } = useAuth()
const { valid, inputs } = useAuthFormInputs()

const form = ref<VForm | null>(null)

const validate = async () => {
  return await form.value?.validate()
}

const execResetPassword = async () => {
  const result = await validate()
  if (!result?.valid) return

  const isString = !Array.isArray(route.query.token)
  if (!route.query.token && isString) {
    console.error('Doesn\'t exist the required query parameter "token"')
    return
  }

  const payload = {
    email: inputs.email.value,
    password: inputs.password.value,
    password_confirmation: inputs.passwordConf.value,
    token: route.query.token as string,
  }

  await resetPassword(payload)
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
          <VSpacer />
          <VCol justify="end" cols="auto">
            <VBtn :disabled="!valid" color="primary" @click="execResetPassword">
              リセット
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCardText>
  </VCard>
</template>

<style></style>
