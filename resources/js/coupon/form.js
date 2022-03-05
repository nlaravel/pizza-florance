import eventHub from '../event.js';
import vSelect from 'vue-select';
import FileManger from '../components/FileManger.vue';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import form from '../mixins/form';

Vue.component('coupons-form', {
    props: {
        coupons:null,


    },
    mixins: [form],
    components: {
        'v-select': vSelect,
        DatePicker
    },
    data() {
        return {
            saveAction:{
                link: `${BASE_URL}/dashboard/coupon`,
                type: 'post'
            },
            redirectPath:null,
            baseUrl:window.location.origin,
            id:this.coupons?this.coupons.id:null,
            types: ['fixed','percent'],
            coupon_code:this.coupons?this.coupons.coupon_code:null,
            amount:this.coupons?this.coupons.amount:null,
            amount_type:this.coupons?this.coupons.amount_type:null,
            expiry_date:this.coupons?this.coupons.expiry_date:null,
            status:this.coupons?this.coupons.status:0,
            noor:null,
            is_edit_page:this.coupons?true:false,


        }
    },
    mounted (){

        if (this.is_edit_page) {
            this.saveAction = {
                link: `${BASE_URL}/dashboard/coupon/${this.id}`,
                type: 'put'
            };
        }

    },
    methods: {


        save() {
            let data = {
                expiry_date:this.expiry_date,
                id:this.id,
                amount_type:this.amount_type,
                coupon_code:this.coupon_code,
                amount:this.amount,
                status:this.status,

            }
            this.redirectPath=`${BASE_URL}/dashboard/coupon`;
            this.saveForm(data)

        },


    },
    created() {

    }

});
