<template>
  <v-app>
    <cmn-loading />
    <cmn-snackbar :messages="flashMessages" @closeClicked="popMessage" />
    <v-main>
      <cmn-header />
      <v-container>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import CmnHeader from "@/components/common/CmnHeader.vue";
import CmnLoading from "@/components/common/CmnLoading.vue";
import CmnSnackbar from "@/components/common/CmnSnackbar.vue";

import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers("flashMsg");

export default {
  name: "App",
  components: {
    CmnHeader,
    CmnLoading,
    CmnSnackbar,
  },
  computed: {
    flashMessages() {
      return this.$store.state.flashMsg.messages;
    },
  },
  methods: {
    ...mapActions(["removeMessage"]),
    popMessage() {
      this.removeMessage(this.flashMessages.length - 1);
    },
  },
};
</script>
