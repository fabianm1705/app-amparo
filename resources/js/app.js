/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Utilizo Vuex para mantener actualizado el contador del carrito
 */

window.Vue = require('vue');

const Vuex = require('vuex');

const store = new Vuex.Store({
    state:{
      productsCount: 0
    },
    mutations:{
      increment(state){
        return state.productsCount++
      },
      decrement(state){
        return state.productsCount--
      },
      set(state, value){
        return state.productsCount = value
      }
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('material-transition-group-component', require('./components/animations/MaterialCollectionComponent.vue').default);

Vue.component('price-component', require('./components/PriceComponent.vue').default);
Vue.component('product-in-cart-component', require('./components/ProductInCartComponent.vue').default);
Vue.component('cart-component', require('./components/CartComponent.vue').default);
Vue.component('add-to-cart-component', require('./components/AddToCartComponent.vue').default);
Vue.component('add-and-buy-to-cart-component', require('./components/AddAndBuyToCartComponent.vue').default);
Vue.component('cart-counter-component', require('./components/CartCounterComponent.vue').default);
Vue.component('cuotas-value-component', require('./components/CuotasValueComponent.vue').default);
Vue.component('total-value-component', require('./components/TotalValueComponent.vue').default);
Vue.component('total-value-only-component', require('./components/TotalValueOnlyComponent.vue').default);

Vue.component('shopping-component', require('./components/ShoppingComponent.vue').default);
Vue.component('product-in-shopping-component', require('./components/ProductInShoppingComponent.vue').default);

Vue.component('specialty-doctors-table-component', require('./components/SpecialtyDoctorsTableComponent.vue').default);
Vue.component('gen-orders-component', require('./components/GenOrdersComponent.vue').default);
Vue.component('orders-old-component', require('./components/OrdersOldComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});


// Check that service workers are supported
if ('serviceWorker' in navigator) {
  // Use the window load event to keep the page load performant
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js');
  });
}
