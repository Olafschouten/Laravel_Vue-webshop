<template>
  <div class="content-container">
    <h1>Cart</h1>

    <div v-if="cartData.products != null">
      <div v-for="product in cartData.products" :key="product.id">
        <p>{{ product['title'] }}</p>
        <p>Quantity: {{ product['qty'] }}</p>
        <p>$: {{ product['price'] }}</p>
        <button @click="addOne(product)">Add one</button>
        <button @click="reduceOne(product)">Reduce one</button>
        <button @click="removeAll(product)">Remove all</button>
      </div>

      <h2>Total: ${{ cartData.totalPrice }}</h2>

      <router-link to="/checkout">Checkout</router-link>
    </div>
    <div v-else>
      <p>Nothing in cart</p>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';

export default {
    name: 'Cart',
    computed: {
        ...mapActions('cart', ['setState', 'getCartProducts']),
        ...mapGetters('cart', { cartData: 'getCart' }),
    },
    methods: {
        ...mapActions('cart', [
            'addToCartAction',
            'addOne',
            'reduceOne',
            'removeAll',
        ]),
        addToCart(productId) {
            this.addToCartAction(productId);
        },
    },
};
</script>
