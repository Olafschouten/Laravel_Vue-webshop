<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <a class="navbar-brand" href="/#/home">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/#/products">Products <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#/categories">Categories <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#/about">About<span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <div class="nav-item">
                    <a class="nav-link" href="/#/cart">Cart<span class="sr-only">(current)</span></a>
                </div>

                <div class="nav-item dropdown" v-if="authenticated">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ user.name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right1" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/#/dashboard">Dashboard</a>
                        <a class="dropdown-item" href="/#/profile">Account settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" @click.prevent="signOut">Logout</a>
                    </div>
                </div>

                <div v-else>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/#/login">Login <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#/signup">Register <span
                                class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import {mapState, mapActions} from "vuex";

export default {
    computed: {
        ...mapState('auth', ['authenticated', 'user'])
    },
    methods: {
        ...mapActions({
            signOutAction: 'auth/signOut'
        }),

        async signOut() {
            await this.signOutAction()

            await this.$router.replace({path: '/home'})
        }
    }
}
</script>
