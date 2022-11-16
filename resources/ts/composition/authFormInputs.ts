import { reactive, ref } from 'vue'
import type { VForm } from 'vuetify/components'

export const useAuthFormInputs = () => {
  const valid = ref(true)

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
      rules: [
        (v: string) => !!v || 'パスワードは入力必須です',
        (v: string): boolean | string => {
          return (
            v === inputs.password.value || '確認用パスワードが一致していません'
          )
        },
      ],
    },
    remember: true,
    // admin: {
    //   value: false,
    //   label: '管理者',
    //   rules: [
    //     v => !!v || '入力を行ってください',
    //   ],
    // },
  })

  return {
    valid,
    inputs,
  }
}
