@extends('dashboard_layout.main')
@push('style')
    <style>
    .img-upload{
    float: left !important;
    }

    </style>

@endpush
@section('content')
    <user-profile :userdata='{!! auth()->user()->toJson() !!}'
                  inline-template>
        <div>
        <file-manger :issidebaractive="fileManageSidebar"></file-manger>
        <!-- users edit start -->
        <section class="users-edit">
            <div class="card">

                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                    <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">@lang('lang.profile')</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">


                                <!-- users edit account form start -->
                                <form  id="data_form_user" onsubmit="return false;" >
                                    <div class="row">

                                        <div class="col-12 col-sm-8">

                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>@lang('lang.name')</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" v-model="name"  name="name" value="{{auth()->user()->name}}">
                                                    <span class="form-control-feedback" style="color: #ff2300;" v-if="form.error && form.validations.name">@{{ form.validations.name[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>@lang('lang.email')</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" readonly class="form-control" v-model="email"  name="email" value="{{auth()->user()->email}}">
                                                    <span class="form-control-feedback" style="color: #ff2300;" v-if="form.error && form.validations.email">@{{ form.validations.email[0] }}</span>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <span>@lang('lang.password') </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-model="password" type="password" name="password" class="form-control" placeholder="@lang('lang.password') " >

                                                </div>
                                            </div>
                                            {{--<div class="form-group row">--}}
                                                {{--<div class="col-md-2">--}}
                                                    {{--<span>تغيير الصورة</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}


                                                    {{--<input type="file"  class="form-control"  @change="onImageChange" name="image" id="img" placeholder="Profile Cover" multiple>--}}


                                                {{--</div>--}}
                                            {{--</div>--}}
                                        </div>

                                            {{--<div class="form-group row">--}}
                                            {{--<div class="col-md-2">--}}
                                            {{--<span>الاسم</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input type="text" class="form-control" v-model="name"  name="name" value="{{auth()->user()->name}}">--}}
                                            {{--<span class="form-control-feedback" style="color: #ff2300;" v-if="validation">@{{ validation.name[0] }}</span>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group">
                                                    <div class="controls" >


                                                        <div class="upload-photo">

                                                            <div class="con-img-upload" >
                                                                <div  class="img-upload" v-if="image" >
                                                                    <button @click="removeImage(0)" type="button" class="btn-x-file">
                                                                        <i translate="translate" class="material-icons notranslate"> clear </i>
                                                                    </button>
                                                                    <img :src="image_url" style="max-width: none; max-height: 100%;">
                                                                </div>
                                                            </div>
                                                            <div class="upload-photo" v-if="!image">
                                                                <div class="con-upload" >
                                                                    <div class="con-img-upload">
                                                                        <div class="con-input-upload" @click="toggleFileManagerSidebar(true)">
                                                                            <span class="text-input">@lang('lang.upload file')</span>
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


                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1"  @click='save()' >
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">@lang('lang.save')
                                        </button>
                                        <button  onclick="location.href = '/dashboard';" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                    </div>
                                </form>
                            </div>

                            <!-- users edit account form ends -->
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <!-- users edit ends -->
        </div>
    </user-profile>
    @push('script')


    @endpush


@stop