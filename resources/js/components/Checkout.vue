<template>
    <div>
        <h1>Checkout</h1>

        <div v-if="cartData.products != null">
            <div v-for="product in cartData.products" :key="product.id">
                <p>{{ product["title"] }}</p>
                <p>Quantity: {{ product["qty"] }}</p>
                <p>$: {{ product["price"] }}</p>
            </div>

            <h2>Total: ${{ cartData.totalPrice }}</h2>
            <h1>Checkout form</h1>

            <form @submit.prevent="testFunction">
                <div class="form-group">
                    <label for="fullName">Full name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="fullName"
                        id="fullName"
                        v-model="fields.fullName"
                    />
                    <div v-if="errors && errors.fullName" class="text-danger">
                        {{ errors.fullName[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="zip">Zip</label>
                    <input
                        type="text"
                        class="form-control"
                        name="zip"
                        id="zip"
                        v-model="fields.zip"
                    />
                    <div v-if="errors && errors.zip" class="text-danger">
                        {{ errors.zip[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="streetHouseNumber">Street + House number</label>
                    <input
                        type="text"
                        class="form-control"
                        name="streetHouseNumber"
                        id="streetHouseNumber"
                        v-model="fields.streetHouseNumber"
                    />
                    <div v-if="errors && errors.streetHouseNumber" class="text-danger">
                        {{ errors.streetHouseNumber[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        v-model="fields.email"
                    />
                    <div v-if="errors && errors.email" class="text-danger">
                        {{ errors.email[0] }}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Send message</button>
            </form>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import CheckoutMixin from "../CheckoutMixin";
import axios from "axios";

export default {
    name: "Checkout",
    mixins: [CheckoutMixin],

    data() {
        return {
            action: "api/checkout ",
            fields: {
                fullName: this.$store.state.auth.user.name,
                email: this.$store.state.auth.user.email,
                zip: "",
                streetHouseNumber: "",
                user_id: this.$store.state.auth.user.id,
                cart: JSON.stringify(localStorage.getItem('cart')),
            }
        };
    },
    computed: {
        ...mapActions("cart", ["setState", "getCartProducts"]),
        ...mapGetters("cart", {cartData: "getCart"}),
    },
    methods: {
        ...mapActions("cart", [
            "addToCartAction",
            "addOne",
            "reduceOne",
            "removeAll",
        ]),
        addToCart(productId) {
            this.addToCartAction(productId);
        },
        testFunction: function () {
            axios.get('/sanctum/csrf-cookie')
                .then(() => {
                    axios.post('/api/checkout', [this.fields])
                        .then((res) => {
                            // console.log(res)
                            localStorage.removeItem('cart')
                            this.$router.push({path: "/dashboard"});
                        })
                        .catch(error => {
                            console.log(error.response.data.message)
                        })
                })
                .catch(error => {
                    console.log(error.response.data.message)
                })
        }
    },
};
</script>
