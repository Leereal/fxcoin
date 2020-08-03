import App from './App.vue';
import Vuex from 'vuex';
import router from './router';
import Swal from 'sweetalert2';
import { Form, HasError, AlertError } from 'vform';
import StoreData from './store/store';
import {initialize} from './helpers/general';

require('./bootstrap');

window.Vue = require('vue');
window.Swal = Swal;
window.Form = Form;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const store = new Vuex.Store(StoreData);

initialize(store, router);

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
