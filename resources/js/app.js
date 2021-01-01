import Vue from 'vue';
import routes from './router/index';
require('./bootstrap');
import { HasError, AlertError } from 'vform'

import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('app-header', require('./components/Header.vue').default);

const app = new Vue({
    el: '#app',
    router: routes
});


