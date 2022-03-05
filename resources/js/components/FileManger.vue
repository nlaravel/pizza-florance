<template>
    <vs-sidebar  click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">


        <div class="vx-row ml-2">
            <vs-tabs>
                <vs-tab label="UploadPhoto" >
                    <vs-alert :active="image_error" color="danger" icon="new_releases" >
                        <span>{{image_error}}</span>
                    </vs-alert>

                    <div class="row">
                        <div class="col-12" >
                            <vue-dropzone  @vdropzone-error="errorFile"  @vdropzone-success="successFile"  ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>

                        </div>
                    </div>
                </vs-tab>


                <vs-tab label="Gallary">
                    <div class="row">
                        <div class="col-8"  style="padding-bottom: 30px;
    border-right: 1px solid #ddd;
    position: relative;
    overflow-x: scroll;
    height: 500px;
">
                            <div class="row mt-2 ml-1"  >
                                <div class="col-12">
                                    <div class="row">
                                        <div class=" col-sm-12 col-md-3 col-lg-3" :key="indextr" v-for="(tr, indextr) in images.data" @click="choicesImage(tr)">

                                            <img v-if="tr.type=='photo'" :src="tr.image_url" style="
        width: inherit;height: 150px;
" alt="latest-upload" class="rounded mb-4 user-latest-image responsive">
                                            <img  v-if="tr.type=='video'" :src="base_url+'/icon/video.png'" class="rounded mb-4 user-latest-image responsive" style="
       width: inherit; height: 150px;
">



                                        </div>
                                    </div>
                                    <div class="row" v-if="getLastPage">

                                        <vs-button  v-if="images.next_page_url" type="relief" class="m-auto" @click="loadMore(images.next_page_url)">Load More
                                        </vs-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4" >
                            <div class="vx-row">
                                <div class="vx-col w-full">
                                    <vs-input  label="Search " @keyup.enter="getAllData"  v-model="search_word" class="mt-1 mb-1 w-full" name="search_word"   />
                                </div>
                            </div>

                            <div class="con-img-upload"  v-if="choicesImageSelected">
                                <div class="img-upload"  >
                                    <button @click="" type="button" class="btn-x-file">
                                        <i translate="translate" class="material-icons notranslate"> clear </i>
                                    </button>

                                    <img   v-if="choicesImageSelected.type=='photo'"  :src="choicesImageSelected.image_url" style="max-width: none; max-height: 100%;">
                                    <video  v-if="choicesImageSelected.type=='video'" controls>
                                        <source :src="choicesImageSelected.image_url" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="vx-row">
                                <div class="vx-col w-full">
                                    <vs-input v-if="choicesImageSelected" label=" Photo Description"  v-model="photo_caption" class="mt-1 mb-1 w-full" name="photo_caption"  />
                                </div>
                            </div>
                            <div class="vx-row">
                                <div class="vx-col ">
                                    <vs-button v-if="choicesImageSelected" @click="destory" color="danger" type="filled">Delete</vs-button>
                                    <vs-button v-if="choicesImageSelected" @click="save" color="success"  type="filled">Save</vs-button>
                                </div>
                            </div>

                        </div>
                    </div>
                </vs-tab>


            </vs-tabs>
        </div>

        <div class="row mx-0 mr-3 my-2" style="float: right;" slot="footer">
            <vs-button class="mr-1" @click="saveData" >Save</vs-button>
            <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Cancel</vs-button>
        </div>
    </vs-sidebar>
</template>

<script>
    import eventHub from "../event.js";
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import VuePerfectScrollbar from 'vue-perfect-scrollbar'
    export default {
        props: {
            issidebaractive: {
                type: Boolean,
                required: true
            }
        },
        components: {
            VuePerfectScrollbar,
            vueDropzone: vue2Dropzone
        },
        data() {
            return {
                settings:{
                    maxScrollbarLength:60,
                    wheelSpeed:0.6
                },
                dropzoneOptions: {
                    url: BASE_URL+'/dashboard/fileManger/uploader',
                    thumbnailWidth: 150,
                    maxFilesize: 44444425000,
                    timeout: 1800000000000000,
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    }
                },
                currentPage:1,
                images:{},
                icons:{},
                image_error:null,
                icon_error:null,
                currentImage:null,
                currentIcon:null,
                choicesImageSelected:null,
                choicesIconSelected:null,
                base_url:window.location.origin,
                search_word:null,
                photo_caption:null
            }

        },
        watch: {
            isSidebarActive(val) {

            }
        },
        computed: {
            isSidebarActiveLocal: {
                get() {
                    return this.issidebaractive
                },
                set(val) {
                    if(!val) {
                        eventHub.$emit('closeFileManagerSidebar');
                        // this.$emit('openSidebar');
                        // this.$validator.reset()
                        // this.initValues()
                    }
                }
            },
            getLastPage(){
                return this.images.to <=this.images.total;
            },

        },
        methods: {
            updateCurrImg(input) {
                if (input.target.files && input.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = e => {
                        this.image_url = e.target.result
                        console.log(this.dataImg);
                    }
                    reader.readAsDataURL(input.target.files[0])
                }
            },

            getAllData(){
                if(this.search_word){
                    axios.get(BASE_URL+'/dashboard/fileManger?page='+this.currentPage+'&search='+this.search_word).then(response => {this.images = response.data.data});

                }else{
                    axios.get(BASE_URL+'/dashboard/fileManger?page='+this.currentPage).then(response => {this.images = response.data.data});
                }
            },

            loadMore($utl){
                axios.get($utl).then(response => {
                    let  array_images = this.images.data;
                    let test=array_images.concat(response.data.data.data);
                    this.images.next_page_url =response.data.data.next_page_url;
                    this.images.data=test;

                })
            },

            videoSending(file, xhr, formData){
                formData.append('type','video')

            },
            choicesImage($id){
                this.choicesImageSelected = $id;
                this.photo_caption = $id.photo_caption
                console.log($id)
            },
            choicesIcon($id){
                this.choicesIconSelected = $id;
                console.log($id)
            },
            destory(){
                let self = this;
                axios.delete(BASE_URL+'/dashboard/fileManger/'+self.choicesImageSelected.id).then(response=> {
                    const index_2 = this.images.data.indexOf(self.choicesImageSelected);
                    this.images.data.splice(index_2, 1);
                    self.choicesImageSelected=null;
                    this.$vs.notify({
                        color: 'success',
                        title: 'Deleted Image'
                    })
                });
            },
            successFile(file,respone){
                this.image_error = null
                this.images.data.unshift(respone.imageObject);
                this.currentImage = respone.imageObject;
                this.choicesImageSelected =null;
                this.choicesIconSelected =null;
                eventHub.$emit("my-event",this.currentImage);
            },

            errorFile(file,message,xhr){
                this.image_error = null;
                this.image_error=message.errors.file?message.errors.file[0]:message.message;

                //this.image_error=message
                console.log(message);
            },

            saveData(){
                this.isSidebarActiveLocal = false;
                if(this.choicesImageSelected){
                    eventHub.$emit("my-event",this.choicesImageSelected);
                }


            },
            save(){
                let self = this;
                axios.put(BASE_URL+'/dashboard/fileManger/'+self.choicesImageSelected.id,{
                    'photo_caption':this.photo_caption
                }).then(response=> {
                    this.$vs.notify({
                        color: 'success',
                        title: 'Image Name Save'
                    })
                });
            },
        },
        created() {
            this.getAllData();

        }
    }
</script>

<style lang="scss" scoped>
    .add-new-data-sidebar {
        ::v-deep .vs-sidebar--background {
            z-index: 52010;
        }

        ::v-deep .vs-sidebar {
            z-index: 52010;
            width: 80% !important;
            max-width: 90vw;

            .img-upload {
                margin-top: 2rem;

                .con-img-upload {
                    padding: 0;
                }

                .con-input-upload {
                    width: 100%;
                    margin: 0;
                }
            }
        }

    }

    .scroll-area--data-list-add-new {
        // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
        height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

        &:not(.ps) {
            overflow-y: auto;
        }
    }
    .dropzone {
        min-height: 500px;
    }

    .vs-sidebar--items {
        overflow-y: unset !important;
    }
    .dropzone .dz-message{
        text-align: center;
    }
    .vuesax-app-is-rtl .vs-sidebar.vs-sidebar-position-right {
        right: 10%;
    }
    .vs-tabs--content{
        padding: 0px 10px;
    }


    .vuesax-app-is-ltr .con-img-upload .img-upload {
        float: right;
    }


</style>