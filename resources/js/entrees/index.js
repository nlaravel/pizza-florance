import eventHub from '../event.js';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import form from '../mixins/form';
Vue.component('entrees-index', {
    props: {
        entrees:null,
    },
    mixins: [form],
    components: {
        vueDropzone: vue2Dropzone

    },
    data() {
        return {
            entrees_all:this.entrees,
            currentx:1,
            saveAction:{
                link: `${BASE_URL}/dashboard/entrees`,
                type: 'post'
            },
            redirectPath:null,
        }
    },
    mounted (){

        eventHub.$on('AfterDelete',(id,index)=>{
            this.entrees_all.splice(index, 1);
        });
    },
    methods: {


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
                    axios.delete(BASE_URL+'/dashboard/entrees/'+id
                    ).then(response => {
                        eventHub.$emit('AfterDelete',id,index);
                        this.$swal('Deleted', 'You successfully deleted this file', 'success')
                    })

                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
        },


        edit(id){


            let link ='/dashboard/entrees/'+id+'/edit';
            window.location.replace(BASE_URL+link);

        },



        onChangePage() {
            axios.get(BASE_URL+'/dashboard/entrees?page='+this.currentx
            ).then(response => {
                this.entrees_all=response.data.data;
            })
        }

    },


});