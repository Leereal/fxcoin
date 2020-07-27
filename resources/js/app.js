require('./bootstrap');

window.Vue = require('vue');

import Swal from 'sweetalert2';

window.Swal = Swal;

import { Form, HasError, AlertError } from 'vform';
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

import App from './App.vue';

import router from './router';
new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
