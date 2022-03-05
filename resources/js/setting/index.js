import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import form from '../mixins/form';
Vue.component('setting-index', {
    props: {
        data:null,
    },
    mixins: [form],
    components: {
        FileManger
    },

    data() {
        return {
            current_image:1,
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            validation:null,
            message:null,
            id:null,
            email:this.data.email,
            website_name:this.data.website_name,
            mobile_1:this.data.mobile_1,
            mobile_2:this.data.mobile_2,
            mobile_3:this.data.mobile_3,
            address_1:this.data.address_1,
            address_2:this.data.address_2,
            logo:this.data.logo,
            logo_url:window.location.origin+'/'+this.data.logo,
            youtube:this.data.youtube,
            facebook:this.data.facebook,
            twitter:this.data.twitter,
            instagram:this.data.instagram,
            linked_in:this.data.linked_in,
            seo_keyword:this.data.seo_keyword,
            iframe:this.data.iframe,
            time_to:this.data.time_to,
            time_from:this.data.time_from,
            delivery_cost:this.data.delivery_cost,
            currency:this.data.currency,
            tax:this.data.tax,
            seo_website_description:this.data.seo_website_description,
            favicon_url:window.location.origin+'/'+this.data.favicon,
            favicon:this.data.favicon,
            redirectPath: `${BASE_URL}/dashboard/setting`,
            saveAction: {
                link: `${BASE_URL}/dashboard/setting`,
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
                website_name:this.website_name,
                mobile_1:this.mobile_1,
                email:this.email,
                mobile_2:this.mobile_2,
                mobile_3:this.mobile_3,
                iban:this.iban,
                logo:this.logo,
                address_1:this.address_1,
                address_2:this.address_2,
                facebook:this.facebook,
                twitter:this.twitter,
                instagram:this.instagram,
                linked_in:this.linked_in,
                seo_keyword:this.seo_keyword,
                currency:this.currency,
                tax:this.tax,
                seo_website_description:this.seo_website_description,
                favicon:this.favicon,
                iframe:this.iframe,
                time_from:this.time_from,
                time_to:this.time_to,
                delivery_cost:this.delivery_cost,
            };
            this.saveForm(data);


        },


        toggleFileManagerSidebar(val=false,test){
            this.fileManageSidebar = val,
            this.current_image=test
        },
        removeImage($image){
            if($image == 0){

                this.logo=null;
                this.logo_url=null;
                return true;
            }
            if($image == 1){
                this.favicon=null;
                this.favicon_url=null;
                return true;
            }

        },

    },
    created() {
        eventHub.$on("closeFileManagerSidebar", ($data) => {
            this.fileManageSidebar =false;
    });

        eventHub.$on("my-event", ($data) => {

            if(!this.logo && this.current_image ==1){
            this.logo= $data.file_name;
            this.logo_url=$data.image_url;
            return true;
        }
        if(!this.favicon && this.current_image ==2){
            this.favicon= $data.file_name;
            this.favicon_url=$data.image_url;
            return true;
        }





    });
    }
});
