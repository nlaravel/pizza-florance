import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import form from '../mixins/form';

Vue.component('entrees-form', {
    props: {
        entrees:null,


    },
    mixins: [form],
    components: {
        FileManger
    },
    data() {
        return {
            saveAction:{
                link: `${BASE_URL}/dashboard/entrees`,
                type: 'post'
            },
            redirectPath:null,
            current_image:1,
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            id:this.entrees?this.entrees.id:null,
            name:this.entrees?this.entrees.name:null,
            price:this.entrees?this.entrees.price:null,
            description:this.entrees?this.entrees.description:null,
            image:this.entrees?this.entrees.image:null,
            image_url:this.entrees?this.entrees.image_url:null,
            is_edit_page:this.entrees?true:false,


        }
    },
    mounted (){
        if (this.is_edit_page) {
            this.saveAction = {
                link: `${BASE_URL}/dashboard/entrees/${this.id}`,
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
                price:this.price,
                name:this.name,
                description:this.description,

            }
            this.redirectPath=`${BASE_URL}/dashboard/entrees`;
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
