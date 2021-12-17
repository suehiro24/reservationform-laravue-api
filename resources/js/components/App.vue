<template>
  <v-app>
    <cmn-header />
    <router-view />
  </v-app>
</template>

<script>
import CmnHeader from "@/components/common/CmnHeader.vue";
import CmnLoading from "@/components/common/CmnLoading.vue";

export default {
  name: "App",
  components: {
    CmnHeader,
    CmnLoading,
  },
};
</script>
