import eventHub from '../event.js';
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import { quillEditor } from 'vue-quill-editor'
import form from '../mixins/form';
Vue.component('terms-index', {
    props: {
        terms:null,
    },
    mixins: [form],
    components: {
        quillEditor
    },

    data() {
        return {

            baseUrl:window.location.origin,
            id:null,
            description:this.terms.description,
            redirectPath: `${BASE_URL}/dashboard/terms`,
            saveAction: {
                link: `${BASE_URL}/dashboard/terms`,
                type: 'post'
            },


        }
    },
    mounted (){

    },
    methods: {
        save(){
            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            let data ={
                description:this.description,

            };
            this.saveForm(data);


        },




    },

});
