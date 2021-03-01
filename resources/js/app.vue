<template>
  <div id="id">
    <nav-bar></nav-bar>
    <div class="container pt-3">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import NavBar from './components/NavBar';
import {mapState} from 'vuex';

export default {
    name: 'app',
    components: {
        NavBar,
    },
};
</script>
