require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios';

window.axios = axios;

import Clients from './components/Clients.vue';
import Products from './components/Products.vue';

const app = new Vue({
    el: '#app',
    components: {
        Clients,
        Products
    }
});
