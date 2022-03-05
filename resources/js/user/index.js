import eventHub from '../event.js';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import form from '../mixins/form';
Vue.component('users-index', {
    props: {
        users:null,
    },
    mixins: [form],
        components: {
            vueDropzone: vue2Dropzone

    },
    data() {
        return {
            pageOfItems: [],
            users_all:this.users,
            currentx:1,
         //   BASE_URL:window.location.origin,
            validation:null,
            message:null,
            image_error:null,
            name:null,
            email:null,
            image:null,
            image_url:null,
           // role_id:null,
            phone:null,
            password:null,
            id:null,
            saveAction:{
                link: `${BASE_URL}/dashboard/user`,
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
            this.users_all.splice(index, 1);
    });
    },
    methods: {
        save() {
            let data = {
                image:this.image,
                id:this.id,
                name:this.name,
                email:this.email,
                password:this.password,
                phone:this.phone,

            }
            this.saveForm(data)

        },
        action(){
            this.reset();
            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
        },
        reset(){
            this.id=null;
            this.name=null;
            this.email=null;
            this.phone=null;
            this.image=null;
            this.password=null;
            this.address=null;
            this.program_id=null;
            this.index=null;
        },
        edit(property,index){
            console.log(property,index)
            this.index=index;
             this.id=property.id;
            this.name=property.name;
            this.email=property.email
            this.image_url=property.image_url;
            this.image=property.image;
            this.password=property.password;

            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
            this.saveAction = {
                link: `${BASE_URL}/dashboard/user/`+property.id,
                type: 'put'
            };


        },
        successFile(file,respone){

            this.currentImage = respone.imageObject;
            this.image=this.currentImage.file_name,
            this.image_url=this.currentImage.image_url,
            console.log(file,respone,this.currentImage)
        },
        errorFile(file,message,xhr){
            this.image_error = null;
            this.image_error=message.errors.file?message.errors.file[0]:message.message;

            //this.image_error=message
            console.log(message);
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
                axios.delete(BASE_URL+'/dashboard/user/'+id
                ).then(response => {
                                eventHub.$emit('AfterDelete',id,index);
                this.$swal('Deleted', 'You successfully deleted this file', 'success')
                        })

                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
            },





        onChangePage() {
            axios.get(BASE_URL+'/dashboard/user?page='+this.currentx
            ).then(response => {
                this.users_all=response.data.data;
             })
        }

    },


});