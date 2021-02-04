<template>
    <div>
        <div v-if="category.category">
            <h1>{{ category.category.title }}</h1>
            <br/>
            <div v-if="category.products !== 0">
                <div v-for="product in category.products" v-bind:key="product.id">
                    <h3>{{ product.title }}</h3>
                    <p>{{ product.description }}</p>
                    <p>$ {{ product.price }}</p>
                    <hr/>
                    <!--          <img v-bind:src="product.image" alt="img" width="100" height="100" />-->
                    <ul>
                        <li>
                            <a v-bind:href="'/#/product/' + product.id">Link to product</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-else>
                <p>No category products</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "category",
    data() {
        return {
            category: {
                id: "",
                title: "",
                created_at: "",
                products: {},
            },
        };
    },

    created() {
        const route = this.$route.fullPath;
        this.fetchCategory(route);
    },

    methods: {
        fetchCategory(route) {
            const page_url = "api" + route;
            fetch(page_url)
                .then((res) => res.json())
                .then((res) => {
                    this.category = res;
                })
                .catch((err) => console.log(err));
        },
    },
};
</script>
