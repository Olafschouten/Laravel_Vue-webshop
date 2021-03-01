import Vuex from 'vuex';
import Vue from 'vue';
import productModule from './modules/product';
import cartModule from './modules/cart';
import authModule from './modules/auth';
import paginationModule from './modules/pagination';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        products: productModule,
        cart: cartModule,
        auth: authModule,
        pagination: paginationModule,
    },
});
