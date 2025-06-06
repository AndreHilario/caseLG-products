require('./bootstrap');
window.Vue = require('vue');
Vue.component('products-component', require('./components/ProductsComponent.vue').default);
const app = new Vue({ el: '#app' });