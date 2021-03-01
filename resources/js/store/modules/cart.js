import axios from 'axios';

export default {
    namespaced: true,
    state: {
        cart: {},
    },
    mutations: {
        ADD_TO_CART(state, newStateData) {
            state.cart = newStateData;
        },
        ADD_TO_CART_STATE(state, productData) {
            state.cart = productData;
        },
        ADD_PRODUCT_TO_CART(state, productData) {
            var data = JSON.parse(localStorage.cart);

            const obj = {
                id: productData.data['product'].id,
                qty: 1,
                price: productData.data['product'].price,
            };

            if (data.products.length) {
                var exist = false;
                for (var i = 0; i < data.products.length; i++) {
                    var keyValues = Object.values(data.products);
                    if (keyValues[i]['id'] === obj['id']) {
                        keyValues[i]['qty']++;
                        exist = true;
                        break;
                    }
                }
                if (!exist) {
                    data.products.push(obj);
                    exist = false;
                }
            } else if (!data.products.length) {
                data.products.push(obj);
            }

            data.totalPrice += productData.data['product'].price;

            localStorage.cart = JSON.stringify(data);
            state.cart = data;
        },
        ADD_ONE(state, product) {
            for (var i = 0; i < state.cart.products.length; i++) {
                if (state.cart.products[i]['id'] === product['id']) {
                    state.cart.products[i]['qty']++;
                }
            }
            state.cart.totalPrice += product.price;
            localStorage.cart = JSON.stringify(state.cart);
        },
        REDUCE_ONE(state, product) {
            for (var i = 0; i < state.cart.products.length; i++) {
                if (state.cart.products[i]['id'] === product['id']) {
                    state.cart.products[i]['qty']--;
                }
            }
            state.cart.totalPrice -= product.price;
            localStorage.cart = JSON.stringify(state.cart);
        },
        REMOVE_ALL(state, product) {
            var cartData = state.cart.products;
            for (let i = 0; i < state.cart.products.length; i++) {
                if (state.cart.products[i]['id'] === product['id']) {
                    for (let a = 0; a < product["qty"]; a++) {
                        const totalPrice = product['qty'] * product.price;
                        state.cart.totalPrice -= totalPrice;
                        state.cart.products.splice(a, 1);
                        break;
                    }
                }
            }
            localStorage.cart = JSON.stringify(state.cart);
        },
    },
    actions: {
        async addToCartAction({ commit }, id) {
            try {
                if (!localStorage.cart) {
                    localStorage.cart = JSON.stringify({ products: [], totalPrice: 0 });
                }
                const productData = await axios.get(
                    `http://localhost:8000/api/product/${id}`,
                );
                commit('ADD_PRODUCT_TO_CART', productData);
            } catch (err) {
                return console.log(err);
            }
        },
        setState({ commit }) {
            try {
                if (!localStorage.cart) {
                    localStorage.cart = JSON.stringify({ products: [], totalPrice: 0 });
                }
                commit('ADD_TO_CART', JSON.parse(localStorage.cart));
            } catch (err) {
                return console.log(err);
            }
        },
        async getCartProducts({ commit }) {
            try {
                const cart = JSON.parse(localStorage.cart);

                var cartData = { totalPrice: cart.totalPrice, products: [] };
                for (var i = 0; i < cart.products.length; i++) {
                    const product = await axios.get(
                        `http://localhost:8000/api/product/${cart.products[i]['id']}`,
                    );
                    Object.assign(product.data.product, { qty: cart.products[i]['qty'] });
                    cartData.products.push(product.data.product);
                }
                commit('ADD_TO_CART_STATE', cartData);
            } catch (err) {
                return console.log(err);
            }
        },
        addOne({ commit }, product) {
            try {
                commit('ADD_ONE', product);
            } catch (err) {
                return console.log(err);
            }
        },
        reduceOne({ commit }, product) {
            try {
                if (product.qty <= 1) {
                    commit('REMOVE_ALL', product);
                } else if (product.qty >= 2) {
                    commit('REDUCE_ONE', product);
                }
            } catch (err) {
                return console.log(err);
            }
        },
        removeAll({ commit }, product) {
            try {
                commit('REMOVE_ALL', product);
            } catch (err) {
                return console.log(err);
            }
        },
    },

    getters: {
        getCart: state => state.cart,
    },
};
