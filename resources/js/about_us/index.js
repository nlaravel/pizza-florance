import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import form from '../mixins/form';
Vue.component('about-index', {
    props: {
        about:null,
    },
    mixins: [form],
    components: {
        FileManger
    },
    data() {
        return {
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            validation:null,
            message:null,
            id:null,
            image:this.about.image,
            title:this.about.title,
            sub_title:this.about.sub_title,
            description:this.about.description,
            image_url:window.location.origin+'/'+this.about.image,
            redirectPath: `${BASE_URL}/dashboard/about_us`,
            saveAction: {
                link: `${BASE_URL}/dashboard/about_us`,
                type: 'post'
            },


        }
    },
    mounted (){

    },
    methods: {
        save(){
            let data ={
                title:this.title,
                sub_title:this.sub_title,
                description:this.description,
                image:this.image,
            };
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
