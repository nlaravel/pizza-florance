import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import form from '../mixins/form';
Vue.component('user-profile', {
    props: {
        userdata: Object
    },
    mixins: [form],
    components: {
        FileManger
    },
    data() {
        return {
            name:this.userdata.name,
            id:this.userdata.id,
            email:this.userdata.email,
            image:this.userdata.image,
            image_url:this.userdata?this.userdata.image_url:null,
            password:null,
            baseUrl:window.location.origin,
            selectedfile:null,
            //validations:null,
            fileManageSidebar:false,
            is_edit_page:this.userdata?true:false,
            redirectPath: `${BASE_URL}/dashboard/profile`,
            saveAction: {
                link: `${BASE_URL}/dashboard/profile`,
                type: 'post'
            },
        }
    },
    mounted (){

    },
    methods: {
        save() {
            let data ={
             name:this.name,
             email:this.email,
             image:this.image,
             password:this.password,
         }
            this.saveForm(data);



        },

        toggleFileManagerSidebar(val=false){
            this.fileManageSidebar = val
        },
        removeImage($image){

            if($image == 0){
                this.image=null;
                this.image_url=null;
                return true;
            }


        },

    },

    created() {

        eventHub.$on("closeFileManagerSidebar", ($data) => {
            this.fileManageSidebar =false;
    });

        eventHub.$on("my-event", ($data) => {

            if(!this.image){
            this.image= $data.file_name;
            this.image_url=$data.image_url;
            return true;
        }

    });
    }

});