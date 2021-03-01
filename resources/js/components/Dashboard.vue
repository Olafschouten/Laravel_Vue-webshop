<template>
  <div>
    <h1>Dashboard</h1>
    <div v-if="user">
      <h2>Name: {{ user.name }}</h2>
      <h3>Email: {{ user.email }}</h3>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import {mapActions, mapState} from 'vuex';

axios.defaults.withCredentials = true;

export default {
    name: 'Dashboard',
    computed: {
        ...mapState('auth', {
            user: 'user',
            auth: 'authenticated',
        }),
    },
    async mounted() {
        await this.me();
    },
    methods: {
        ...mapActions('auth', ['me']),
    },
};
</script>
