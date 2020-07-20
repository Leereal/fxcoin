import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Profile from './components/Profile.vue';

Vue.use(VueRouter);
const routes = [
    {path:'/',component: Dashboard},
    {path:'/dashboard',component: Dashboard},
    {path:'/profile',component: Profile}

];
const router = new VueRouter({
    routes:routes,
    mode: 'history'
});
export default router;