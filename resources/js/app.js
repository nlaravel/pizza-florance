/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
import Vue from 'vue'
import VueI18n from 'vue-i18n';
Vue.use(VueI18n);
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';


Vue.use(VueSweetalert2);
import vSelect from "vue-select";

Vue.component("v-select", vSelect);
import "vue-select/dist/vue-select.css";
import Vuesax from 'vuesax'

import 'vuesax/dist/vuesax.css' //Vuesax styles
import 'material-icons/iconfont/material-icons.css';
Vue.use(Vuesax, {
    theme:{
        colors:{
            primary:'#7367F0',
            success:'#28C76F',
            danger:'#EA5455',
            warning:'#FF9F43',
            dark:'#FFFFFF'
        }
    }
})
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('notification', require('./components/Notification.vue').default);
Vue.component('notification-item', require('./components/NotificationItem.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
require('./profile/index').default;
require('./user/index').default;
require('./setting/index').default;
require('./about_us/index').default;
require('./contact-us/index').default;
require('./product/index').default;
require('./product/form').default;
require('./category/index').default;
require('./category/form').default;
require('./day/index').default;
require('./ingredient/index').default;
require('./terms/index').default;
require('./entrees/form').default;
require('./entrees/index').default;
require('./calzone_category/index').default;
require('./calzone_size/index').default;
require('./pizza_category/index').default;
require('./pizza_size/index').default;
require('./topping/index').default;
require('./coupon/index').default;
require('./coupon/form').default;
require('./payment/index').default;
require('./payment/form').default;
require('./state/index').default;
require('./city/index').default;
require('./city/form').default;
require('./order/index').default;
const app = new Vue({
    el: '#app',
});
const messages = {
    'en': {        welcomeMsg: 'Welcome to Your Vue.js App'    },
    'ar': {        welcomeMsg: 'Bienvenido a tu aplicación Vue.js'    }};
