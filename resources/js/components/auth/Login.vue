<template>
  <v-card>
    <v-card-text>
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
      >
        <v-text-field
          v-model="inputs.email.value"
          :rules="inputs.email.rules"
          :label="inputs.email.label"
          type="email"
          required
        ></v-text-field>

        <v-text-field
          v-model="inputs.password.value"
          :counter="inputs.password.counter"
          :rules="inputs.password.rules"
          :label="inputs.password.label"
          type="password"
          required
        ></v-text-field>

        <v-row class='mt-0'>
          <v-spacer />
          <v-col
            justify='end'
            cols="auto"
          >
            <v-btn
              :disabled="!valid"
              color="primary"
              @click="execLogin"
            >
              ログイン
            </v-btn>
          </v-col>
        </v-row>

      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
const { mapActions } = createNamespacedHelpers('auth')

export default {
  name: 'Login',
  data: () => ({
    valid: true,
    /**
     * 入力項目
     */
    inputs: {
      email: {
        value: '',
        label: 'メールアドレス',
        rules: [
          v => !!v || 'メールアドレスを入力してください',
          v => /.+@.+\..+/.test(v) || '有効なメールアドレスを入力してください',
        ],
      },
      password: {
        value: '',
        counter: 15,
        label: 'パスワード',
        rules: [
          v => !!v || 'パスワードを入力してください',
        ],
      },
    },
  }),
  methods: {
    ...mapActions([
      'login',
    ]),
    async execLogin () {
      const payload = {
        email: this.inputs.email.value,
        password: this.inputs.password.value,
      }
      await this.login(payload)
    },
  },
}
</script>

<style>

</style>
