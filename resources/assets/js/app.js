require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios';

window.axios = axios;

import Clients from './components/Clients.vue';
import Products from './components/Products.vue';
import Categories from './components/Categories.vue';
import AssignProducts from './components/assign-products.vue';



const app = new Vue({
    el: '#app',
    components: {
        Clients,
        Products,
        Categories,
        AssignProducts,
    }
});
