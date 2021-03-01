<template>
  <div class="home col-sm-12 col-md-8 col-lg-6 mx-auto py-5 mt-5">
    <h1 class="text-center">Register</h1>
    <div class="card">
      <form action="#">
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name:</label>
            <input
              type="text"
              v-model="form.name"
              class="form-control"
              id="name"
            />
            <span class="text-danger" v-if="errors.name">
            {{ errors.name[0] }}
          </span>
          </div>
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
          <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input
              type="password"
              v-model="form.password_confirmation"
              class="form-control"
              id="password_confirmation"
            />
            <span class="text-danger" v-if="errors.password_confirmation">
            {{ errors.password_confirmation[0] }}
          </span>
          </div>
          <button
            type="submit"
            @click.prevent="register"
            class="btn btn-primary btn-block"
          >
            Register
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import {mapActions} from 'vuex';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/';

export default {
    name: 'Register',
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: [],
        };
    },
    methods: {
        register() {
            this.signUp(this.form)
                .then(() => {
                    this.$router.push({ path: '/dashboard' });
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
        ...mapActions('auth', ['signUp']),
        ...mapActions('auth', ['checkEmail', 'checkPassword']),
    },
};
</script>
