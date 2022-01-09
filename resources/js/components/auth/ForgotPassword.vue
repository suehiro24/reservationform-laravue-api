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
              @click="execForgotPassword"
            >
              パスワードリセット用メールを送る
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
  name: 'ForgotPassword',
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
          v => !!v || 'メールアドレスは入力必須です',
          v => /.+@.+\..+/.test(v) || '有効なメールアドレスを入力してください',
        ],
      },
    },
  }),

  methods: {
    ...mapActions([
      'forgotPassword',
    ]),
    async execForgotPassword () {
      if (!this.validate()) return

      const payload = {
        email: this.inputs.email.value,
      }
      await this.forgotPassword(payload)
    },
    validate () {
      return this.$refs.form.validate()
    },
  },
}
</script>
