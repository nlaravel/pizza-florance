import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import form from '../mixins/form';

Vue.component('categories-form', {
    props: {
        categories:null,
        category_size:Object,


    },
    mixins: [form],
    components: {
        FileManger
    },
    data() {
        return {
            saveAction:{
                link: `${BASE_URL}/dashboard/category`,
                type: 'post'
            },
            sizes:[],
            redirectPath:null,
            current_image:1,
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            id:this.categories?this.categories.id:null,
            add_size:this.categories?this.categories.add_size:0,
            name:this.categories?this.categories.name:null,
            image:this.categories?this.categories.image:null,
            image_url:this.categories?this.categories.image_url:null,
            is_edit_page:this.categories?true:false,


        }
    },
    mounted (){
        this.sizes.push({ size: null,price: null });
        if( this.category_size){
            this.sizes = this.category_size;
        }
        if (this.is_edit_page) {
            this.saveAction = {
                link: `${BASE_URL}/dashboard/category/${this.id}`,
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

        addItems() {
            this.sizes.push({size: null,price: null});
        },
        deleteItems(index) {
            this.sizes.splice(index, 1);
        },
        save() {
            let data = {
                image:this.image,
                id:this.id,
                name:this.name,
                add_size:this.add_size,
                sizes:this.sizes,

            }
            this.redirectPath=`${BASE_URL}/dashboard/category`;
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
