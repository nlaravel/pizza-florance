@extends('dashboard_layout.main')
@push('style')
    <style>
        .img-upload{
            float: left !important;
        }

        .vuesax-app-is-ltr .con-img-upload .img-upload {
            float: none !important;
        }
        .vuesax-app-is-ltr .con-input-upload {
            float: none !important;
        }
          .vs-checkbox-default{
              margin-top: 116px;
            margin-left: -297px !important;
              margin-right: -18px;
        }
        .vs-checkbox-primary input:checked ~ .vs-checkbox {
            height: 23px;
        }
    </style>

@endpush
@section('content')
    <categories-form
            :categories='{!!  isset($category) ? $category : 'null' !!}'
            :category_size='{!!  isset($category) ? $category->sizes : 'null' !!}'

            inline-template>
        <div>
            <file-manger :issidebaractive="fileManageSidebar"></file-manger>


            <!-- users edit start -->
            <section class="users-edit">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">Categories</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->

                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->
                                    <div class="row">

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control"   v-model="name"  id="name" name="name" >
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                    <vs-checkbox  v-model="add_size">Add Size to Category</vs-checkbox>

                                            </div>


                                        </div>


                                        <div class="col-12 col-sm-6">

                                            <div class="controls" style="text-align: center;">
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h5>@lang('lang.image')</h5>
                                                        <div class="upload-photo" >

                                                            <div class="con-img-upload"  >
                                                                <div  class="img-upload"  style="margin: 20px auto" v-if="image" >
                                                                    <button @click="removeImage(0)" type="button" class="btn-x-file">
                                                                        <i translate="translate" class="material-icons notranslate"> clear </i>
                                                                    </button>
                                                                    <img :src="image_url" style="max-width: none; max-height: 100%;">
                                                                </div>
                                                            </div>
                                                            <div class="upload-photo" v-if="!image">
                                                                <div class="con-upload" >
                                                                    <div class="con-img-upload"  >
                                                                        <div class="con-input-upload" style="margin: 20px auto" @click="toggleFileManagerSidebar(true,1)">
                                                                            <span class="text-input">Upload File</span>
                                                                            <span class="input-progress" style="width: 0%;"></span>
                                                                            <button disabled="disabled" type="button" title="Upload" class="btn-upload-all vs-upload--button-upload">
                                                                                <i translate="translate" class="material-icons notranslate">cloud_upload</i>
                                                                            </button>
                                                                            <span class="text-danger " ></span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{--<vs-upload  automatic   text="Product Images"   :data="dataForUploadFunction"  :limit="5" :headers="config" :action="url" @on-error="errorUpload" @on-delete="deleteUpload" @on-success="successUpload" />--}}
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    {{--<div class="row" v-if="add_size !=0">--}}
                                        {{--<div class="col-12">--}}
                                            {{--<div class="card">--}}
                                                {{--<div class="card-header">--}}
                                                    {{--<h4 class="mb-0"> Add  Size</h4>--}}
                                                {{--</div>--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<div class="table-responsive mt-1">--}}
                                                        {{--<table class="table table-hover-animation mb-0">--}}
                                                            {{--<thead>--}}
                                                            {{--<tr>--}}
                                                                {{--<th>Size</th>--}}
                                                                {{--<th>Price</th>--}}
                                                                {{--<th>Action</th>--}}
                                                            {{--</tr>--}}
                                                            {{--</thead>--}}
                                                            {{--<tbody>--}}

                                                            {{--<tr v-for="(size, index) in sizes">--}}

                                                                {{--<td><input   class="form-control"  style="width: 90%;" v-model="size.size"/></td>--}}
                                                                {{--<td><input   class="form-control"  style="width: 90%;" v-model="size.price"/></td>--}}
                                                                {{--<td><i class="feather icon-trash"  @click="deleteItems(index)" ></i></td>--}}
                                                            {{--</tr>--}}

                                                            {{--</tbody>--}}


                                                        {{--</table>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<button  class="btn btn-outline-danger"  @click="addItems()">Add New Size--}}
                                            {{--</button>--}}
                                        {{--</div>--}}


                                    {{--</div v-if=>--}}
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" @click="save()">@lang('lang.Saved_change')
                                        </button>
                                        <button type="reset" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                    </div>
                                    <!-- users edit account form ends -->
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->



        </div>
    </categories-form>
    @push('script')


    @endpush


@stop