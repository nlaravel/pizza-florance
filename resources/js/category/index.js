import eventHub from '../event.js';
import vSelect from 'vue-select';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import form from '../mixins/form';
Vue.component('categories-index', {
    props: {
        categories:null,
        parentcategories:null,
    },
    mixins: [form],
    components: {
        'v-select': vSelect,
        vueDropzone: vue2Dropzone

    },
    data() {
        return {
            pageOfItems: [],
            categories_all:this.categories,
            currentx:1,
            image_error:null,
            name:null,
            image:null,
            image_url:null,
            parent_id:null,
            id:null,
            saveAction:{
                link: `${BASE_URL}/dashboard/category`,
                type: 'post'
            },
            redirectPath:null,
            index:null,
            currentImage:null,
            dropzoneOptions: {
                url: BASE_URL+'/dashboard/fileManger/uploader',
                thumbnailWidth: 150,
                maxFilesize: 44444425000,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                }
            },
        }
    },
    mounted (){

        eventHub.$on('AfterDelete',(id,index)=>{
            this.categories_all.splice(index, 1);
        });
    },
    methods: {
        save() {
            let data = {
                image:this.image,
                id:this.id,
                name:this.name,
                parent_id:this.parent_id ?this.parent_id.id:0,

            }
            this.saveForm(data)

        },
        edit(id){


            let link ='/dashboard/category/'+id+'/edit';
            window.location.replace(BASE_URL+link);

        },


        deleteRecord(id,index){
            let title="<b>{{test.save}}</b>";
            this.$swal({
                title: "Are you Sure",
                text: 'You can\'t revert your action',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes Delete it!',
                cancelButtonText: 'No, Keep it!',
                showCloseButton: true,
                showLoaderOnConfirm: true
            }).then((result) => {
                if(result.value) {
                    axios.delete(BASE_URL+'/dashboard/category/'+id
                    ).then(response => {

                        this.$swal('Deleted', 'You successfully deleted this file', 'success')
                    })
                    eventHub.$emit('AfterDelete',id);
                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
        },





        onChangePage() {
            axios.get(BASE_URL+'/dashboard/category?page='+this.currentx
            ).then(response => {
                this.categories_all=response.data.data;
            })
        }

    },


});