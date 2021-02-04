<template>
    <div>
        <h1>Products</h1>

        <div class="row">
            <div v-for="product in results.data" v-bind:key="product.id" class="col-sm-6 col-md-3 col-lg-2">
                <h3>{{ product.title }}</h3>
                <!--                <p>{{ product.description }}</p>-->
                <p>$ {{ product.price }}</p>
                <hr/>
                <!--                 <img v-bind:src="product.image" alt="img" width="100" height="100" /> -->
                <ul>
                    <li>
                        <a v-bind:href="'/#/product/' + product.id" class="">Link to product</a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="addToCart(product.id)"> Add to cart</a>
                    </li>
                </ul>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul>
                <li v-if="pagination.prev_page_url" v-bind:class="{ disabled: !pagination.prev_page_url }">
                    <a href="#" @click.prevent="fetchProducts(pagination.prev_page_url)"
                    >Previous</a>
                </li>

                <li v-else>
                    <span>No pre page</span>
                </li>

                <li>
                    <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
                </li>

                <li v-if="pagination.next_page_url" v-bind:class="{ disabled: !pagination.next_page_url }">
                    <a href="#" @click.prevent="fetchProducts(pagination.next_page_url)">Next</a>
                </li>
                <li v-else>
                    <span>No next page</span>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import axios from "axios";

export default {
    name: "Products",
    data() {
        return {
            results: {},
            pagination: {}
        }
    },
    mounted() {
        axios.get("/api/products")
            .then((res) => {
                this.results = res.data
                this.makePagination(this.results.meta, this.results.links)
            })
            .catch((err) => console.log(err))
    },
    computed: {
        // ...mapActions("cart", ["setState"]),
        // ...mapGetters("cart", ["getCart"])
    },
    methods: {
        fetchProducts(page_url) {
            axios.get(page_url)
                .then((res) => {
                    this.results = res.data
                    this.makePagination(res.data.meta, res.data.links)
                })
                .catch((err) => console.log(err))
        },
        makePagination(meta, links) {
            this.pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }
        },
        ...mapActions("products", ["getProductsAction"]),
        ...mapActions("cart", ["addToCartAction"]),
        addToCart(productId) {
            this.addToCartAction(productId);
        },
    },
};
</script>
