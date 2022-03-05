Vue.component('auth-login', {
    data(){
        return {
            email: null,
            password: null,
            remember: false,
            form: {
                disabled: false,
                error: false,
                validations: [],
                message: null,
            }
        }
    },
    methods: {
        login() {
            this.form.disabled = true;
            axios.post(`${BASE_URL}/login`, {
                email: this.email,
                password: this.password,
                remember: this.remember,
            }).then(response => {
                location.href = `${BASE_URL}/dashboard`;
        }).catch(error => {
                this.form.error = true;
            if(error.response.data.errors) {
                this.form.validations = error.response.data.errors;
                this.form.message = null;
            }
            else if(error.response.data.message) {
                this.form.validations = [];
                this.form.message =  error.response.data.message;
            }
            this.form.disabled = false;
        })
        },
    }
});