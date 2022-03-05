
require('./bootstrap');

window.Vue = require('vue');


require('./auth/login').default;

const app = new Vue({
    el: '#login-form'
});
