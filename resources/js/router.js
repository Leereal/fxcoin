import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Profile from './components/Profile.vue';
import Package from './components/Package.vue';
import PaymentMethod from './components/PaymentMethod.vue';
import Currency from './components/Currency.vue';
import PaymentDetail from './components/PaymentDetail.vue';

Vue.use(VueRouter);
const routes = [    
    {path:'/dashboard',component: Dashboard},
    {path:'/profile',component: Profile},
    {path:'/packages',component: Package},
    {path:'/payment-methods',component: PaymentMethod},
    {path:'/currencies',component: Currency},
    {path:'/payment-details',component: PaymentDetail},

];
const router = new VueRouter({
    routes:routes,
    mode: 'history'
});
export default router;