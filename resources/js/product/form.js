import eventHub from '../event.js';
import FileManger from '../components/FileManger.vue';
import vSelect from 'vue-select';
import form from '../mixins/form';
import VueTagsInput from '@johmun/vue-tags-input';
Vue.component('product-form', {
    props: {
        products:null,
        categories:null,
        days:null,
        ingredients:null,
        products_extra:Object,
        entrees:null,
        product_size:Object,
        product_entrees:Object,
        difference:Object,
    },
    mixins: [form],
    components: {
        'v-select': vSelect,
        VueTagsInput,
        FileManger
    },
    data() {
        return {
            saveAction:{
                link: `${BASE_URL}/dashboard/product`,
                type: 'post'
            },
            entrees_all:this.entrees,
            difference_all:this.difference,
            redirectPath:null,
            extras:[],
            tests:{},
            sizes:[],
           // ingredients:this.products ? JSON.parse(this.products.ingredients.split(',')) : [],
            current_image_size:null,
            current_image:1,
            fileManageSidebar:false,
            baseUrl:window.location.origin,
            id:this.products?this.products.id:null,
            name:this.products?this.products.name:null,
            day:this.products?this.products.days:null,
            ingredient:this.products?this.products.ingredients:null,
            days_all:this.days,
            ingredients_all:this.ingredients,
         //  day:this.products? JSON.parse(this.products.days.split(',')):[],
            // days:[{value:"Friday",name:"Friday"},{value:"Saturday",name:"Saturday"},{value:"Sunday",name:"Sunday"},{value:"Monday",name:"Monday"}
            //     ,{value:"Tuesday",name:"Tuesday"},{value:"Wednesday",name:"Wednesday"},{value:"Thursday",name:"Thursday"}],
            category_id:this.products?this.products.categories:null,
            price:this.products?this.products.price:null,
          //  ingredient:'',
            description:this.products?this.products.description:null,
            image:this.products?this.products.image:null,
            image_url:this.products?this.products.image_url:null,
            is_edit_page:this.products?true:false,


        }
    },
    mounted (){
        eventHub.$on('AfterDelete',(id,index)=>{
            this.entrees_all.splice(index, 1);
        });
        this.extras.push({ name: null, price: null });
        if( this.products_extra){
            this.extras = this.products_extra;
        }
        this.sizes.push({ size: null,price: null, image: null ,image_url:null });
        if( this.product_size){
            this.sizes = this.product_size;
        }
        if( this.product_entrees){
         //  this.tests = [{entrees_id:null}];
        }

        if (this.is_edit_page) {
            this.saveAction = {
                link: `${BASE_URL}/dashboard/product/${this.id}`,
                type: 'put'
            };
        }

    },
    methods: {
        addItem() {
            this.extras.push({name: null,price:null});
        },
        deleteRecord(id,index){
            console.log(id);
            axios.delete(BASE_URL+'/dashboard/product_entress/'+id.id

            ).then(response => {
                this.$vs.notify({
                    color: 'success',
                    icon: 'success',
                    title: 'Deleted'
                })
                //this.entrees_all.splice(index, 1);
                const idx = this.product_entrees.indexOf(id)
                this.product_entrees.splice(idx, 1)
                this.entrees_all.splice(idx, 1)
                this.difference_all.push(id);

            }).catch(error => {

            })
        },

        deleteItem(index) {
            this.extras.splice(index, 1);
        },


        toggleFileManagerSidebar(val=false,test,current_image_siz=null){
            this.fileManageSidebar = val,
                this.current_image=test,
                this.current_image_size=current_image_siz
        },
        removeImage($image){
            if($image == 0){

                this.image=null;
                this.image_url=null;
                return true;
            }


        },
        update(newTags) {
            this.autocompleteItems = [];
            this.ingredients = newTags;
        },
        addData(test,index){
            console.log(test,index)

                this.tests['product_' + test] ={'entrees_id': test}
           // this.tests['index']={'entrees_id': test};
            this.$vs.notify({
                color: 'success',
                icon: 'success',
                title: 'Added to Array Click save to save your change !'
            })

        },

        save() {
            let data = {
                image:this.image,
                id:this.id,
                price:this.price,
               extras:this.extras,
                name:this.name,
               category_id:this.category_id?this.category_id.id:null,
                ingredient:this.ingredient,
                day:this.day,
                description:this.description,
                sizes:this.sizes,
                tests:this.tests,

            }
            this.redirectPath=`${BASE_URL}/dashboard/product`;
            this.saveForm(data)

        },
        addItems() {
            this.sizes.push({size: null,price: null,image:null,image_url:null});
        },
        deleteItems(index) {
            this.sizes.splice(index, 1);
        },
        remove(index) {
            this.sizes[index].image='';
            this.sizes[index].image_url='';
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
            if(this.current_image_size != null &&this.current_image==2){
                this.sizes[this.current_image_size].image = $data;
                this.sizes[this.current_image_size].image = $data.file_name;
                this.sizes[this.current_image_size].image_url = $data.image_url;
                return true;
            }

        });
    }

});
