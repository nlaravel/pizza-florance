import eventHub from '../event.js';
import form from '../mixins/form';
Vue.component('day-index', {
    props: {
        days:null,
    },
    mixins: [form],
    components: {

    },
    data() {
        return {
            days_all:this.days,
            currentx:1,
            name:null,
            id:null,
            saveAction:{
                link: `${BASE_URL}/dashboard/day`,
                type: 'post'
            },
            redirectPath:null,
            index:null,
        }
    },
    mounted (){

        eventHub.$on('AfterDelete',(id,index)=>{
            this.days_all.splice(index, 1);
        });
    },
    methods: {
        save() {
            let data = {
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
        },
        edit(property,index){
            console.log(property,index)
            this.index=index;
            this.id=property.id;
            this.name=property.name;

            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
            this.saveAction = {
                link: `${BASE_URL}/dashboard/day/`+property.id,
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
                    axios.delete(BASE_URL+'/dashboard/day/'+id
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
            axios.get(BASE_URL+'/dashboard/day?page='+this.currentx
            ).then(response => {
                this.days_all=response.data.data;
            })
        }

    },


});