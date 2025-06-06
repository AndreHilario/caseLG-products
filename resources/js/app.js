import Vue from 'vue';
import '../sass/app.scss';
import Products from './views/Products.vue';

// Instância principal
new Vue({
  render: h => h(Products)
}).$mount('#app');