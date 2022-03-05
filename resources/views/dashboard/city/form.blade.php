@extends('dashboard_layout.main')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin-layout/app-assets/css/pages/app-ecommerce-shop.css')}}">

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
        #wishlist .card, .card .card{
            box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.1) !important;
        }
    </style>

@endpush
@section('content')
    <city-form
            :city='{!!  isset($city) ? $city : 'null' !!}'
            :states='{!!  isset($state) ? $state : 'null' !!}'
            :cities_zip_codes='{!!  isset($city) ? $city->zip_codes : 'null' !!}'
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
                                        <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Cities</span>
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
                                                    <label>Name</label>
                                                    <input type="text" class="form-control"   v-model="name"  id="name" name="name" >
                                                    <span v-if="form.error && form.validations.name" style="color: red">@{{ form.validations.name[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>State</label>
                                                    <div>
                                                        <v-select  label="name" dir="ltr" v-model="state_id" :options="states" :dir="$vs.rtl ? 'rtl' : 'ltr'"  />
                                                    </div>
                                                    <span v-if="form.error && form.validations.state_id" style="color: red">@{{ form.validations.state_id[0] }}</span>

                                                </div>
                                            </div>
                                            <div class="form-group" >
                                                <div class="controls" v-for="(zip_code, index) in zip_codes">
                                                    <label>Zip Code</label>
                                                    <span><i style="float: right" class="feather icon-trash"  @click="deleteItem(index)" ></i></span>
                                                    <input type="text" class="form-control"   v-model="zip_code.zip_code"  id="zip_code" name="zip_code" >


                                                </div>
                                            </div>
                                            <button  class="btn btn-outline-danger feather icon-plus"  @click="addItem()">Add  ZipCode
                                                    </button>
                                        </div>




                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                            <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" @click="save()">@lang('lang.Saved_change')
                                            </button>
                                            <button type="reset" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                        </div>
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
    </city-form >
    @push('script')

    @endpush


@stop