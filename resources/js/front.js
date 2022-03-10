
require('./bootstrap');

window.Vue = require('vue');
import App from './views/App';
import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Products from './pages/Products.vue';
import Product from './pages/Product.vue';

const route = new VueRouter(
{
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
            path: '/product',
            name: 'product',
            component: Product
        }
    ],
});

const app = new Vue({
    el: '#app',
    render: h => h(App),

});