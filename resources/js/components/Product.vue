<template>
    <div>
        <div v-if="product.product">
            <h1>{{ product.product.title }}</h1>
            {{ product.product.description }}
            <br/>
            $ {{ product.product.price }}
            <br/>
            <!--            <img-->
            <!--                v-bind:src="product.product.image"-->
            <!--                alt="img"-->
            <!--                width="100"-->
            <!--                height="100"-->
            <!--            />-->
            <!--            <br/>-->
            <button @click="addToCart(product.id)" class="btn btn-primary">Add to cart</button>
        </div>
        <br>
        <h3>Categories</h3>
        <div v-if="product.categories !== 0">
            <div v-for="category in product.categories" v-bind:key="category.id">
                <h3>{{ category.title }}</h3>
                <ul>
                    <li>
                        <a v-bind:href="'/#/category/' + category.id">Link to category</a>
                    </li>
                </ul>
            </div>
        </div>
        <div v-else>
            <p>No product categories</p>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import axios from "axios";

export default {
    name: "Product",
    data() {
        return {
            product: {
                id: "",
                title: "",
                price: "",
                description: "",
                image: "",
                url: "",
                created_at: "",
                categories: {},
            },
        };
    },

    // mounted(route) {
    //     console.log(route)
    //     axios.get("/api" + route)
    //         .then((res) => {
    //             this.results = res.data
    //             this.makePagination(this.results.meta, this.results.links)
    //         })
    //         .catch((err) => console.log(err))
    // },

    created() {
        const route = this.$route.fullPath;
        this.fetchProducts(route);
    },

    methods: {
        fetchProducts(route) {
            const page_url = "api" + route;
            fetch(page_url)
                .then((res) => res.json())
                .then((res) => {
                    this.product = res;
                })
                .catch((err) => console.log(err));
        },
        ...mapActions("cart", ["addToCartAction"]),
        addToCart(productId) {
            this.addToCartAction(productId);
        },
    },
};
</script>
