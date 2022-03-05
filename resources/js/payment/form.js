import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import form from '../mixins/form';

Vue.component('payment-form', {
    props: {
        payment:null,


    },
    mixins: [form],
    components: {
        FileManger
    },
    data() {
        return {
            saveAction:{
                link: `${BASE_URL}/dashboard/payment`,
                type: 'post'
            },
            sizes:[],
            redirectPath:null,
            current_image:1,
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            id:this.payment?this.payment.id:null,
            name:this.payment?this.payment.name:null,
            image:this.payment?this.payment.image:null,
            image_url:this.payment?this.payment.image_url:null,
            is_edit_page:this.payment?true:false,


        }
    },
    mounted (){

        if (this.is_edit_page) {
            this.saveAction = {
                link: `${BASE_URL}/dashboard/payment/${this.id}`,
                type: 'put'
            };
        }

    },
    methods: {


        toggleFileManagerSidebar(val=false,test){
            this.fileManageSidebar = val,
                this.current_image=test

        },
        removeImage($image){
            if($image == 0){

                this.image=null;
                this.image_url=null;
                return true;
            }


        },

        save() {
            let data = {
                image:this.image,
                id:this.id,
                name:this.name,

            }
            this.redirectPath=`${BASE_URL}/dashboard/payment`;
            this.saveForm(data)

        },


    },
    created() {

        eventHub.$on("closeFileManagerSidebar", ($data) => {
            this.fileManageSidebar =false;
        });

        eventHub.$on("my-event", ($data) => {

            if(!this.image &&this.current_image==1){
                this.image= $data.file_name;
                this.image_url=$data.image_url;
                return true;
            }


        });
    }

});
