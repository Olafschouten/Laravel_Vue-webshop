<template>
    <div>
        <h1>Categories</h1>
        <div class="row">
            <div v-for="category in results.data" v-bind:key="category.id" class="col-sm-12 col-md-5 col-lg-3">
                <h3>{{ category.title }}</h3>
                <ul>
                    <!-- <li><router-link to="product.url">Link</router-link></li> -->
                    <li>
                        <a v-bind:href="'/#/category/' + category.id">Link to category</a>
                    </li>
                </ul>
                <hr/>
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
import axios from "axios";

export default {
    name: "Categories",
    data() {
        return {
            results: {},
            pagination: {}
        }
    },
    mounted() {
        axios.get("/api/categories")
            .then((res) => {
                this.results = res.data
                this.makePagination(this.results.meta, this.results.links)
            })
            .catch((err) => console.log(err))
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
    }
};
</script>
