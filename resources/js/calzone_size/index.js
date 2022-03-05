import eventHub from '../event.js';
import vSelect from 'vue-select';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import form from '../mixins/form';
Vue.component('calzone_size-index', {
    props: {
        calzone_size:null,

    },
    mixins: [form],
    components: {
        'v-select': vSelect,
        vueDropzone: vue2Dropzone

    },
    data() {
        return {
            pageOfItems: [],
            calzone_size_all:this.calzone_size,
            currentx:1,
            image_error:null,
            name:null,
            price:null,
            id:null,
            saveAction:{
                link: `${BASE_URL}/dashboard/calzone_size`,
                type: 'post'
            },
            redirectPath:null,
            index:null,

        }
    },
    mounted (){

        eventHub.$on('AfterDelete',(id,index)=>{
            this.calzone_size_all.splice(index, 1);
        });
    },
    methods: {
        save() {
            let data = {
                price:this.price,
                id:this.id,
                name:this.name,

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
            this.price=null;
        },
        edit(property,index){
            console.log(property,index)
            this.index=index;
            this.id=property.id;
            this.name=property.name;
            this.price=property.price;
            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
            this.saveAction = {
                link: `${BASE_URL}/dashboard/calzone_size/`+property.id,
                type: 'put'
            };


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
                    axios.delete(BASE_URL+'/dashboard/calzone_size/'+id
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
            axios.get(BASE_URL+'/dashboard/calzone_size?page='+this.currentx
            ).then(response => {
                this.calzone_size_all=response.data.data;
            })
        }

    },


});