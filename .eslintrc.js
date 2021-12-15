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
    semi: ['error', 'never'],
    'indent': ['error', 2],
    'quotes': [2, 'single', { 'avoidEscape': true }],
    'space-before-function-paren': ['error', 'always'],
    'space-before-blocks': ['error', 'always'],
    "comma-spacing": ['error', {"before": false, "after": true}],
    "key-spacing": ["error", {"afterColon": true}],
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

    // Uncategorized, Extension Rules
    'vue/block-tag-newline': 'error',
    'vue/html-button-has-type': 'error',
    'vue/html-comment-content-spacing': 'error',
    'vue/html-comment-indent': 'error',
    'vue/html-indent': 'error',
    'vue/match-component-file-name': ['error', {
      extensions: ['vue'],
      shouldMatchCase: true,
    }],
    'vue/require-name-property': 'error',

    'vue/array-bracket-newline': 'off',
    'vue/array-bracket-spacing': 'error',
    'vue/arrow-spacing': 'error',
    'vue/block-spacing': 'error',
    'vue/brace-style': 'error',
    'vue/camelcase': 'error',
    'vue/comma-dangle': 'error',
    'vue/comma-spacing': 'error',
    'vue/comma-style': 'error',
    'vue/dot-location': 'error',
    'vue/dot-notation': 'error',
    'vue/eqeqeq': 'error',
    'vue/func-call-spacing': 'error',
    'vue/key-spacing': 'error',
    'vue/keyword-spacing': 'error',
    'vue/max-len': 'off',
    'vue/no-constant-condition': 'error',
    'vue/no-empty-pattern': 'error',
    'vue/no-extra-parens': 'error',
    'vue/no-irregular-whitespace': 'error',
    'vue/no-restricted-syntax': 'error',
    'vue/no-sparse-arrays': 'error',
    'vue/no-useless-concat': 'error',
    'vue/object-curly-newline': 'error',
    'vue/object-curly-spacing': ['error', 'always', { objectsInObjects: true }],
    'vue/object-property-newline': 'error',
    'vue/operator-linebreak': 'error',
    'vue/prefer-template': 'error',
    'vue/space-in-parens': 'error',
    'vue/space-infix-ops': 'error',
    'vue/space-unary-ops': 'error',
    'vue/template-curly-spacing': 'error',
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
