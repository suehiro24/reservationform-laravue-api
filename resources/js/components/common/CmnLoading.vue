<template>
  <v-row
    class="ma-0"
    :style="styles"
    align="center"
    justify="center"
    v-show="isLoading"
  >
    <v-progress-circular
      indeterminate
      color="grey"
      :size="70"
      :width="7"
      class="circular"
    />
  </v-row>
</template>

<script>
import zIndexes from '@/components/z-indexes'

export default {
  name: 'CmnLoading',
  computed: {
    isLoading () {
      return this.$store.state.loader.isLoading
    },
  },
  data () {
    return {
      // 画面全体を覆う透明の背景
      styles: {
        zIndex: zIndexes.loading,
        background: 'transparent',
        position: 'fixed',
        height: '100%',
        width: '100%',
        top: '0px',
        left: '0px',
      },
    }
  },
}
</script>

<style scoped>
</style>

