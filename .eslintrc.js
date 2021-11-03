module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    'plugin:vue/essential',
  ],
  parserOptions: {
    ecmaVersion: 2020,
  },
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',

    // -------------------------------------------------------------------------
    // eslint
    // -------------------------------------------------------------------------
    'array-bracket-spacing': 'error',
    camelcase: 'off',
    'comma-dangle': ['error', 'always-multiline'],
    'no-multi-spaces': 'off',
    'object-curly-spacing': ['error', 'always', { objectsInObjects: true }],
    'template-curly-spacing': 'error',

    // -------------------------------------------------------------------------
    // eslint-plugin-vue (https://eslint.vuejs.org/rules)
    // -------------------------------------------------------------------------
    // Priority A: Essential
    // override
    'vue/multi-word-component-names': 'off',
    // Priority B: Strongly Recommended
    // override
    'vue/max-attributes-per-line': 'off',

    // Priority C: Recommended
    // override
    // 'vue/order-in-components': ['error', {}]

    // Uncategorized
    'vue/block-tag-newline': 'error',
    'vue/html-button-has-type': 'error',
    'vue/html-comment-content-spacing': 'error',
    'vue/html-comment-indent': 'error',
    'vue/html-indent': 'error',
    'vue/match-component-file-name': ['error', {
      extensions: ['vue'],
      shouldMatchCase: true,
    }],
  },
  overrides: [
    {
      files: [
        '**/__tests__/*.{j,t}s?(x)',
        '**/tests/unit/**/*.spec.{j,t}s?(x)',
      ],
      env: {
        jest: true,
      },
    },
  ],
}
