<template>
  <div>
    <h1>Contact</h1>
    <p>Information</p>
    <ul>
      <li>E-mail: info@123456789.com</li>
      <li>Telephone: 0123456789</li>
    </ul>
    <p>Adress</p>
    <ul>
      <li>Street and number: Abcde 1</li>
      <li>City: Abcdefg</li>
      <li>ZIP: 1234 AB</li>
    </ul>
    <A HREF="mailto:info@123456789.com">Abcd Company</A>
    <br>
    <form
      id="app"
      @submit="checkForm"
      action="http://127.0.0.1:8000/api/checkout"
      method="post"
    >

      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors">{{ error }}</li>
        </ul>
      </p>

      <p>
        <label for="firstName">Fist name</label>
        <input
          id="firstName"
          v-model="firstName"
          type="text"
          name="firstName"
        >
      </p>

      <p>
        <label for="lastName">Last name</label>
        <input
          id="lastName"
          v-model="lastName"
          type="text"
          name="lastName"
        >
      </p>

      <p>
        <label for="adress">Adress</label>
        <input
          id="adress"
          v-model="adress"
          type="text"
          name="adress"
        >
      </p>

      <p>
        <label for="zip">Zip</label>
        <input
          id="zip"
          v-model="zip"
          type="text"
          name="zip"
        >
      </p>

      <p>
        <label for="street">Street + housenumber</label>
        <input
          id="street"
          v-model="street"
          type="text"
          name="street"
        >
      </p>

      <p>
        <label for="email">Email</label>
        <input
          id="email"
          v-model="email"
          type="text"
          name="email"
        >
      </p>

      <p>
        <input
          type="submit"
          value="Submit"
        >
      </p>

    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
    };
  },
  methods: {
    checkForm: function (e) {
      if (
        this.firstName &&
        this.lastName &&
        this.adress &&
        this.zip &&
        this.street &&
        this.email
      ) {
        return true;
      }

      this.errors = [];

      if (!this.firstName) {
        this.errors.push("Fisrt name required.");
      }
      if (!this.lastName) {
        this.errors.push("Last name required.");
      }
      if (!this.adress) {
        this.errors.push("Adress required.");
      }
      if (!this.zip) {
        this.errors.push("Zip required.");
      }
      if (!this.street) {
        this.errors.push("Street + housenumber required.");
      }
      if (!this.email) {
        this.errors.push("Email required.");
      } else if (!this.validEmail(this.email)) {
        this.errors.push("Valid email required.");
      }

      e.preventDefault();
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
  },
};
</script>

<style>
</style>