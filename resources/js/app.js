
require('./bootstrap');
window.Vue = require('vue');

// vuex----start
import Vuex from 'vuex';
Vue.use(Vuex);
import storeData from './store/store';
const store = new Vuex.Store(
        storeData
  );
// vuex----end

// vue-Router----start
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import {routes} from './route';
const router = new VueRouter({
    routes,
    mode: 'history',
  });
  // vue-Router----End

  // v-form ----start
import { Form, HasError, AlertError } from 'vform'
window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
  // v-form----End

  // Sweetalert----Start
  import Swal from 'sweetalert2'
  window.Swal=Swal;
  const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast=Toast;
  // Sweetalert----End

  // Toastrjs----Start
  import toastr from "toastr";
  window.toastr=toastr;
  // Toastrjs----End


  // Momentjs----Start

import {moment} from "./filter/filter";
  // Momentjs----End

// vue-Component----start
Vue.component('example', require('./components/routeControl.vue').default);
// vue-Component----end

// vue-Instance----start
const app = new Vue({
    el: '#app',
    router,
    store
});
// vue-Instance----End
