
require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueRouter);
import App from './views/App';
import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Products from './pages/Products.vue';
import Product from './pages/Product.vue';
import Contacts from './pages/Contacts.vue';

const router = new VueRouter(
{
    mode: 'history',
    routes: 
    [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/products',
            name: 'products',
            component: Products
        },
        {
            path: '/products/:id',
            name: 'product',
            props: true, 
            component: Product
        },
        {
            path: '/contacts',
            name: 'contacts',
            props: true, 
            component: Contacts
        }
    ],
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});