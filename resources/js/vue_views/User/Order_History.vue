<template>
  <div>
    <h1>Order history</h1>

    <!--        <div class="row">-->
    <!--            <div v-for="product in results.data[0].cart.products" v-bind:key="product.id" class="col-sm-6 col-md-3 col-lg-2">-->
    <!--&lt;!&ndash;                <p>{{ product.description }}</p>&ndash;&gt;-->
    <!--                <p>Qty: {{ product.qty }}</p>-->
    <!--                <p>$ {{ product.price }}</p>-->
    <!--                <hr/>-->
    <!--                &lt;!&ndash;                 <img v-bind:src="product.image" alt="img" width="100" height="100" /> &ndash;&gt;-->
    <!--            </div>-->
    <!--        </div>-->

    <nav aria-label="Page navigation example">
      <ul>
        <li v-if="pagination.prev_page_url" v-bind:class="{ disabled: !pagination.prev_page_url }">
          <a href="#" @click.prevent="fetchData(pagination.prev_page_url)"
          >Previous</a>
        </li>

        <li v-else>
          <span>No pre page</span>
        </li>

        <li>
          <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
        </li>

        <li v-if="pagination.next_page_url" v-bind:class="{ disabled: !pagination.next_page_url }">
          <a href="#" @click.prevent="fetchData(pagination.next_page_url)">Next</a>
        </li>
        <li v-else>
          <span>No next page</span>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import axios from 'axios';
import {mapState, mapActions} from 'vuex';

export default {
    name: 'Order_History',

    data() {
        return {
            results: {},
            pagination: {},
        };
    },

    computed: {
        ...mapState('auth', {
            user: 'user',
            auth: 'authenticated',
        }),
    },

    mounted() {
        axios.get('/api/order_history/' + this.user.id)
            .then((res) => {
                this.results = res.data;
                this.makePagination(this.results.meta, this.results.links);
            })
            .catch((err) => console.log(err));
        this.fetchData('api/order_history/1');
    },

    methods: {
        fetchData(page_url) {
            axios.get(page_url)
                .then((res) => {
                    this.results = res.data;
                    for (let i = 0; i < this.results.data[0].cart.products.length; i++) {
                        console.log(i);
                        axios.get('api/product/' + this.results.data[0].cart.products[i].id)
                            .then((res) => {
                                console.log(res.data.product);
                                this.results.products.push(1);
                            })
                            .catch((err) => console.log(err));
                    }
                    this.makePagination(res.data.meta, res.data.links);
                })
                .catch((err) => console.log(err));
        },

        makePagination(meta, links) {
            this.pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
            };
        },
    },
};
</script>
