require('./bootstrap')

import { createApp } from 'vue'

import router from './router.js'
import App from './layouts/App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

createApp(App)
.use(VueAxios, axios)
      .use(router)
      .mount("#app") 