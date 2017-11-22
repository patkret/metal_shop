require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios';

window.axios = axios;

import store from './store';
import Clients from './components/Clients.vue';
import Products from './components/Products.vue';
import Categories from './components/Categories.vue';;
import PickCategory from './components/PickCategory.vue';
import AssignProductsCategory from './components/AssignProductsCategory.vue';



const app = new Vue({
    el: '#app',
    store,
    components: {
        Clients,
        Products,
        Categories,
        PickCategory,
        AssignProductsCategory
    }
});
