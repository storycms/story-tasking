import Vue from 'vue'
import Axios from 'axios'
import router from './router'
import store from './store'
import App from './layouts/app.vue'

Vue.prototype.$http = Axios.create()
window.EventHub = new Vue({ name: 'EventHub' })

new Vue({
  el: '#app',
  store,
  router,
  template: '<App />',
  components: { App }
})
