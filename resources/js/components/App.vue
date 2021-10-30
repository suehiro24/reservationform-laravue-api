<template>
  <v-app>
    <cmn-header />
    <router-view />
  </v-app>
</template>

<script>
import CmnHeader from "@/components/common/CmnHeader.vue";

export default {
  name: 'App',
  components: {
    CmnHeader: CmnHeader,
  },
};
</script>
