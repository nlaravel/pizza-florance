import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import vSelect from 'vue-select';
import form from '../mixins/form';
import VueTagsInput from '@johmun/vue-tags-input';
Vue.component('city-form', {
    props: {
        city:null,
        states:null,
        cities_zip_codes:null,

    },
    mixins: [form],
    components: {
        'v-select': vSelect,
        VueTagsInput,
        FileManger
    },
    data() {
        return {
            saveAction:{
                link: `${BASE_URL}/dashboard/city`,
                type: 'post'
            },
            redirectPath:null,
            current_image_size:null,
            current_image:1,
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            id:this.city?this.city.id:null,
            name:this.city?this.city.name:null,
          //  zip_code:this.city?this.city.zip_code:null,
            state_id:this.city?this.city.states:null,
            zip_codes:[],

            is_edit_page:this.city?true:false,


        }
    },
    mounted (){


        if (this.is_edit_page) {
            this.saveAction = {
                link: `${BASE_URL}/dashboard/city/${this.id}`,
                type: 'put'
            };
        }

        this.zip_codes.push({ zip_codes: null });
        if( this.cities_zip_codes){
            this.zip_codes = this.cities_zip_codes;
        }

    },
    methods: {

        addItem() {
            this.zip_codes.push({zip_code: null});
        },
        deleteItem(index) {
            this.zip_codes.splice(index, 1);
        },

        save() {
            let data = {
                id:this.id,
                name:this.name,
                zip_codes:this.zip_codes,
                state_id:this.state_id?this.state_id.id:null,

            }
            this.redirectPath=`${BASE_URL}/dashboard/city`;
            this.saveForm(data)

        },


    },


});
