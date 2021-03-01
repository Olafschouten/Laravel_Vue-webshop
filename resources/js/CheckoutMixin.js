export default {
    data() {
        return {
            fields: {},
            errors: {},
            success: false,
            loaded: true,
            action: '',
        };
    },
    methods: {
        submit() {
            Object.assign(this.fields, { cart: localStorage.getItem('cart') });

            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                console.log(this.fields);
                axios
                    .post(this.action, this.fields)
                    // .then(response => {
                    //   this.fields = {}; //Clear input fields.
                    //   this.loaded = true;
                    //   this.success = true;
                    // })
                    .then(response => {
                        // console.log(response);
                        // this.$router.push({path: "/dashboard"});
                    })
                    .catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
            }
        },
    },
};
