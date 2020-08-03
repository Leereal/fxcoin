import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Profile from './components/Profile.vue';
import Package from './components/Package.vue';
import PaymentMethod from './components/PaymentMethod.vue';
import Currency from './components/Currency.vue';
import PaymentDetail from './components/PaymentDetail.vue';
import Login from './auth/Login.vue';
import Register from './auth/Register.vue';
import Home from './auth/Home.vue';
import {initialize} from './helpers/general';


Vue.use(VueRouter);
const routes = [    
    {path:'/dashboard',         name: 'dashboard',          component: Dashboard,       meta: { requiresAuth: true}},
    {path:'/profile',           name: 'profile',            component: Profile,         meta: { requiresAuth: true}},
    {path:'/packages',          name: 'packages',           component: Package,         meta: { requiresAuth: true}},
    {path:'/payment-methods',   name: 'payment-methods',    component: PaymentMethod,   meta: { requiresAuth: true}},
    {path:'/currencies',        name: 'currencies',         component: Currency,        meta: { requiresAuth: true}},
    {path:'/payment-details',   name: 'payment-details',    component: PaymentDetail,   meta: { requiresAuth: true}},
    {path:'/login',             name: 'login',              component: Login},
    {path:'/register',          name: 'register',           component: Register},
    {path:'/',                                              component: Home},
    {path:'/home',              name: 'home',               component: Home},
];
const router = new VueRouter({
    routes:routes,
    mode: 'history',
    base: process.env.BASE_URL
});
export default router;