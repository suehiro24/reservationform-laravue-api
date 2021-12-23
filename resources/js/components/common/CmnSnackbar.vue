<template>
  <div>
    <v-snackbar
      :timeout="-1"
      :value="isShow"
      multi-line
      absolute
      bottom
      color="red accent-2"
      elevation="10"
      v-for="(message, idx) in messages"
      :key="message + idx"
    >
      <template #default>
        {{ message }}
      </template>
      <template #action>
        <v-btn text @click="emitCloseClicked">close</v-btn>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
export default {
  name: 'CmnSnackbar',
  props: {
    messages: { type: Array, required: true },
  },
  computed: {
    isShow () {
      return this.messages.length > 0
    },
  },
  methods: {
    emitCloseClicked () {
      this.$emit('closeClicked')
    },
  },
}
</script>

<style scoped>
</style>

