<template>
  <v-card>
    <v-card-text>
      <v-form
        ref="form"
        v-model="valid"
        lazy-validation
      >
        <v-text-field
          v-model="inputs.name.value"
          :counter="inputs.name.counter"
          :rules="inputs.name.rules"
          :label="inputs.name.label"
          required
        ></v-text-field>

        <v-text-field
          v-model="inputs.email.value"
          :rules="inputs.email.rules"
          :label="inputs.email.label"
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

        <v-text-field
          v-model="inputs.passwordConf.value"
          :counter="inputs.password.counter"
          :rules="[...inputs.passwordConf.rules, passwordConfRule]"
          :label="inputs.passwordConf.label"
          type="password"
          required
        ></v-text-field>

        <!--
          <v-checkbox
          v-model="inputs.admin.value"
          :rules="inputs.admin.rules"
          :label="inputs.admin.lavel"
          required
          ></v-checkbox>
        -->

        <v-row class='mt-0'>
          <v-spacer />
          <v-col
            justify='end'
            cols="auto"
          >
            <v-btn
              :disabled="!valid"
              color="primary"
              @click="execRegister"
            >
              登録
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
  name: 'Register',
  data: () => ({
    valid: true,
    /**
     * 入力項目
     */
    inputs: {
      name: {
        value: '',
        counter: 10,
        label: '氏名',
        rules: [
          v => !!v || '氏名は入力必須です',
          v => (v && v.length <= 10) || '氏名は10文字以内で入力してください',
        ],
      },
      email: {
        value: '',
        label: 'メールアドレス',
        rules: [
          v => !!v || 'メールアドレスは入力必須です',
          v => /.+@.+\..+/.test(v) || '有効なメールアドレスを入力してください',
        ],
      },
      password: {
        value: '',
        counter: 15,
        label: 'パスワード',
        rules: [
          v => !!v || 'パスワードは入力必須です',
          v => (v && v.length <= 15) || 'パスワードは15文字以内で入力してください',
          v => /(?=.*[.!"#$%&'()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~])[a-zA-Z0-9.!"#$%&'()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~]{8,15}/.test(v) ||
               '記号を含む半角英数字で8～15文字のパスワードを入力してください',
        ],
      },
      passwordConf: {
        value: '',
        label: 'パスワード(確認用)',
        rules: [
          v => !!v || 'パスワードは入力必須です',
        ],
      },
      // admin: {
      //   value: false,
      //   label: '管理者',
      //   rules: [
      //     v => !!v || '入力を行ってください',
      //   ],
      // },
    },
  }),

  methods: {
    ...mapActions([
      'register',
    ]),
    async execRegister () {
      if (!this.validate()) return

      const payload = {
        name: this.inputs.name.value,
        email: this.inputs.email.value,
        password: this.inputs.password.value,
        password_confirmation: this.inputs.passwordConf.value,
      }
      await this.register(payload)
    },
    validate () {
      return this.$refs.form.validate()
    },
    // reset () {
    //   this.$refs.form.reset()
    // },
    // resetValidation () {
    //   this.$refs.form.resetValidation()
    // },
    passwordConfRule (v) {
      return v === this.inputs.password.value || '確認用パスワードが一致していません'
    },
  },
}
</script>

<style>

</style>
