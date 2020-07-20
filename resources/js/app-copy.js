require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
    {path: '/', component : require('./components/Dashboard.vue').default},
    {path: '/dashboard', component : require('./components/Dashboard.vue').default},
    {path: '/profile', component : require('./components/Profile.vue').default},
]

const router = new VueRouter({
    routes,
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    router
});
