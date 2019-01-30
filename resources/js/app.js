import Vue from 'vue'
import App from './App.vue';
import router from './router'
import Vuetify from 'vuetify'

import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
import 'font-awesome/css/font-awesome.min.css'

import {store} from './store/index.js'


Vue.config.productionTip = false

import axios from 'axios'

Vue.use(Vuetify)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  render: app => app(App),
  store
})