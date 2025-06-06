import Vue from 'vue'
import Products from './views/Products.vue'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

Vue.use(Toast, {
  position: 'top-right',
  timeout: 3000,
  closeOnClick: true,
  pauseOnHover: true,
  draggable: true,
  showCloseButtonOnHover: false,
})

new Vue({
  render: h => h(Products)
}).$mount('#app')
