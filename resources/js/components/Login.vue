<template>
    <div class="home col-sm-12 col-md-8 col-lg-6 mx-auto py-5 mt-5">
        <h1 class="text-center">Login</h1>
        <div class="card">
            <form action="#">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input
                            type="email"
                            v-model="form.email"
                            class="form-control"
                            id="email"
                        />
                        <span class="text-danger" v-if="errors.email">
                            {{ errors.email[0] }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input
                            type="password"
                            v-model="form.password"
                            class="form-control"
                            id="password"
                        />
                        <span class="text-danger" v-if="errors.password">
                            {{ errors.password[0] }}
                        </span>
                    </div>
                    <button @click.prevent="login" class="btn btn-primary btn-block">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios"
import {mapActions} from 'vuex'

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000/'

export default {
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            errors: []
        }
    },
    methods: {
        login() {
            this.signIn(this.form)
                .then(() => {
                    this.$router.push({path: "/dashboard"});
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },

        ...mapActions('auth', ['signIn']),
        ...mapActions('auth', ['checkEmail', 'checkPassword']),
    },
};
</script>
