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
    </style>

@endpush
@section('content')
    <setting-index :data='{{$settings->toJson()}}' inline-template>
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">@lang('lang.website_information')</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                            <i class="feather icon-share-2 mr-25"></i><span class="d-none d-sm-block"> @lang('lang.social_link')</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->

                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>@lang('lang.email')</label>
                                                        <input type="text" class="form-control"   v-model="email"  id="email" name="email" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>@lang('lang.website_name')</label>
                                                        <input type="text" class="form-control"  v-model="website_name"  id="website_name" name="website_name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>@lang('lang.mobile_1')</label>
                                                        <input type="text" class="form-control"  v-model="mobile_1"  id="mobile_1" name="mobile_1">
                                                    </div>
                                                </div>
                                                {{--<div class="form-group">--}}
                                                    {{--<div class="controls">--}}
                                                        {{--<label>@lang('lang.mobile_2')</label>--}}
                                                        {{--<input type="text" class="form-control"  v-model="mobile_2"  id="mobile_2" name="mobile_2">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<div class="controls">--}}
                                                        {{--<label>@lang('lang.mobile_3')</label>--}}
                                                        {{--<input type="text" class="form-control"  v-model="mobile_3"  id="mobile_3" name="mobile_3">--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label> @lang('lang.address_1')</label>
                                                        <textarea rows="5"  class="form-control" v-model="address_1"  id="address_1" name="address_1" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label> Google Locaition Iframe</label>
                                                        <textarea rows="5"  class="form-control" v-model="iframe"  id="iframe" name="iframe" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label> Delivery Cost</label>
                                                        <input type="text" class="form-control" v-model="delivery_cost"  id="delivery_cost" name="delivery_cost" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label> Currency </label>
                                                        <input type="text" class="form-control" v-model="currency"  id="currency" name="currency" >
                                                    </div>
                                                </div>  <div class="form-group">
                                                    <div class="controls">
                                                        <label> Tax </label>
                                                        <input type="text" class="form-control" v-model="tax"  id="tax" name="tax" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                <div class="controls">
                                                <label>Open From</label>
                                                <input type="text" class="form-control" v-model="time_from"  id="time_from" name="time_from" >
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                <div class="controls">
                                                <label> Open To</label>
                                                <input type="text" class="form-control" v-model="time_to"  id="time_to" name="time_to" >
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>@lang('lang.seo_keyword')</label>
                                                        <input type="text" class="form-control" v-model="seo_keyword"  id="seo_keyword" name="seo_keyword" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>@lang('lang.seo_website_description') </label>
                                                        <textarea class="form-control" id="seo_website_description" rows="5" v-model="seo_website_description"   name="seo_website_description"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 col-sm-6">

                                                <div class="controls" style="text-align: center;">
                                                    <div class="col-12">
                                                        <div class="text-center">
                                                        <h5>@lang('lang.logo')</h5>
                                                        <div class="upload-photo" >

                                                            <div class="con-img-upload" >
                                                                <div  class="img-upload"  style="margin: 20px auto" v-if="logo" >
                                                                    <button @click="removeImage(0)" type="button" class="btn-x-file">
                                                                        <i translate="translate" class="material-icons notranslate"> clear </i>
                                                                    </button>
                                                                    <img :src="logo_url" style="max-width: none; max-height: 100%;">
                                                                </div>
                                                            </div>
                                                            <div class="upload-photo" v-if="!logo">
                                                                <div class="con-upload" >
                                                                    <div class="con-img-upload">
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
                                                        <h5>@lang('lang.favicon')</h5>
                                                        <div class="upload-photo" >

                                                            <div class="con-img-upload" >
                                                                <div  class="img-upload" style="margin: 20px auto" v-if="favicon" >
                                                                    <button @click="removeImage(1)" type="button" class="btn-x-file">
                                                                        <i translate="translate" class="material-icons notranslate"> clear </i>
                                                                    </button>
                                                                    <img :src="favicon_url" style="max-width: none; max-height: 100%;">
                                                                </div>
                                                            </div>
                                                            <div class="upload-photo" v-if="!favicon">
                                                                <div class="con-upload" >
                                                                    <div class="con-img-upload">
                                                                        <div class="con-input-upload"  style="margin: 20px auto" @click="toggleFileManagerSidebar(true,2)">
                                                                            <span class="text-input">Upload File</span>
                                                                            <span class="input-progress" style="width: 0%;"></span>
                                                                            <button disabled="disabled" type="button" title="Upload" class="btn-upload-all vs-upload--button-upload">
                                                                                <i translate="translate" class="material-icons notranslate">cloud_upload</i>
                                                                            </button>
                                                                            <span class="text-danger " ></span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" @click="save()">@lang('lang.Saved_change')
                                                </button>
                                                <button type="reset" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                            </div>
                                        </div>

                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                        <!-- users edit socail form start -->

                                        <div class="row">
                                            <div class="col-12 col-sm-6">

                                                <fieldset>
                                                    <label>@lang('lang.twitter')</label>
                                                    <div class="input-group mb-75">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text feather icon-twitter" id="basic-addon3"></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="twitter"  v-model="twitter"   name="twitter">
                                                    </div>

                                                    <label> @lang('lang.facebook')</label>
                                                    <div class="input-group mb-75">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text feather icon-facebook" id="basic-addon4"></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="facebook"   v-model="facebook"  name="facebook">
                                                    </div>

                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label>@lang('lang.linked_in')</label>
                                                <div class="input-group mb-75">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text fa fa-linkedin" id="basic-addon12"></span>
                                                    </div>
                                                    <input type="text" class="form-control"  id="linked_in"    v-model="linked_in"  name="linked_in">
                                                </div>
                                                <label>@lang('lang.Instagram')</label>
                                                <div class="input-group mb-75">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text feather icon-instagram" id="basic-addon5"></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="instagram"  v-model="instagram"   name="instagram">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" @click="save()">@lang('lang.Saved_change')
                                                </button>
                                                <button type="reset" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                            </div>
                                        </div>

                                        <!-- users edit socail form ends -->

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->



        </div>
    </setting-index>
    @push('script')


    @endpush


@stop