import eventHub from '../event.js';
import vSelect from 'vue-select';
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import form from '../mixins/form';
Vue.component('coupons-index', {
    props: {
        coupons:null,
    },
    mixins: [form],
    components: {

    },
    data() {
        return {
            coupons_all:this.coupons,
            currentx:1,
            id:null,
            saveAction:{
                link: `${BASE_URL}/dashboard/coupon`,
                type: 'post'
            },
            redirectPath:null,
            index:null,


        }
    },
    mounted (){

        eventHub.$on('AfterDelete',(id,index)=>{
            this.coupons_all.splice(index, 1);
        });
    },
    methods: {

        edit(id){


            let link ='/dashboard/coupon/'+id+'/edit';
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
                    axios.delete(BASE_URL+'/dashboard/coupon/'+id
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
            axios.get(BASE_URL+'/dashboard/coupon?page='+this.currentx
            ).then(response => {
                this.coupons_all=response.data.data;
            })
        }

    },


});