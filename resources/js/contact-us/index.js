import eventHub from '../event.js';
import vSelect from 'vue-select';
import form from '../mixins/form';
Vue.component('contacts-index', {
    props: {
        messages:null,
    },
    mixins: [form],
    components: {
        'v-select': vSelect,
    },
    data() {
        return {
            types:[{value:"en",lang:"English"},{value:"ar",lang:"العربية"}],
            type:null,
            messages_all:this.messages,
            BASE_URL:window.location.origin,
            validation:null,
            msg:null,
            full_name:null,
            email:null,
            subject:null,
            city:null,
            phone:null,
            replay_text:null,
            id:null,
            index:null,
            is_replay:null,
            redirectPath: `${BASE_URL}/dashboard/contact`,
            saveAction: {
                link: `${BASE_URL}/dashboard/contact`,
                type: 'post'
            },
            currentx:1,

        }
    },
    mounted (){

        eventHub.$on('AfterDelete',(id,index)=>{
            this.messages_all.splice(index, 1);
        });
    },
    methods: {
        onChangePage() {
            axios.get(BASE_URL+'/dashboard/contact?page='+this.currentx
            ).then(response => {
                this.messages_all=response.data.data;
            })
        },
        action(){
            this.reset();
            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
        },
        reset(){
            this.id=null;
            this.full_name=null;
            this.email=null;
            this.index=null;
        },
        edit(id,index){

            this.id=id;
            this.full_name=id.full_name;
            this.email=id.email;
            this.city=id.city;
            this.phone=id.phone;
            this.subject=id.subject;
            this.replay_text=id.replay_text;
            this.msg=id.message;
            // $(".add-new-data").addClass("show");
            // $(".overlay-bg").addClass("show");


        },
        deleteRecord(id,index){

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
                    axios.delete(BASE_URL+'/dashboard/contact/'+id
                    ).then(response => {
                        eventHub.$emit('AfterDelete',id,index);
                        this.$swal('Deleted', 'You successfully deleted this file', 'success')
                    })

                } else {
                    this.$swal('Cancelled', 'Your file is still intact', 'info')
                }
            })
        },


        save_reply(){
            let data ={
                id:this.id,
                replay_text:this.replay_text,
                type:this.type?this.type.value:null,
                city:this.city,
                phone:this.phone,
            };
            this.saveForm(data);




        },


    }

});