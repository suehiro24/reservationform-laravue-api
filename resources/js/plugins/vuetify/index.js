import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
// Material Design Icons
import '@mdi/font/css/materialdesignicons.css'
// Material Icons
// import 'material-design-icons-iconfont/dist/material-design-icons.css'

Vue.use(Vuetify)

export default new Vuetify({
  icons: {
    iconfont: 'mdi',
    // iconfont: 'md',
  },
})
