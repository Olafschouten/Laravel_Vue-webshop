import axios from "axios";

export default {
    namespaced: true,
    state: {
        products: []
    },
    mutations: {
        GET_PRODUCTS(state, products) {
            state.products = products;
        }
    },
    actions: {
        async getProductsAction({commit}) {
            try {
                const products = await axios.get(`http://127.0.0.1:8000/api/products`);
                commit("GET_PRODUCTS", products);
                return products;
            } catch (error) {
                return console.log(error);
            }
        }
    },
    getters: {
        getProductsData: state => state.products
    }
};
