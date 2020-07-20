require('./bootstrap');

window.Vue = require('vue');

import App from './App.vue';

import router from './router';
new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
