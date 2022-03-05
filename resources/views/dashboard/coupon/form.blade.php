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
    <coupons-form
            :coupons='{!!  isset($coupon) ? $coupon : 'null' !!}'inline-template>


        <div>
            <!-- users edit start -->
            <section class="users-edit">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">Add New coupon</span>
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
                                                    <label>Coupon Code</label>
                                                    <input type="text" class="form-control"   v-model="coupon_code"  id="coupon_code" name="coupon_code" >
                                                    <span v-if="form.error && form.validations.coupon_code" style="color: red">@{{ form.validations.coupon_code[0] }}</span>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Coupon  Amount</label>
                                                    <input type="text" class="form-control"   v-model="amount"  id="amount" name="amount" >
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Coupon Type</label>
                                                    <div>
                                                        <v-select   dir="ltr" v-model="amount_type" :options="types" :dir="$vs.rtl ? 'rtl' : 'ltr'"  />
                                                    </div>
                                                    <span v-if="form.error && form.validations.amount_type" style="color: red">@{{ form.validations.amount_type[0] }}</span>                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Expired Date</label>
                                                    <input type="date" class="form-control"   v-model="expiry_date"  id="expiry_date" name="expiry_date" >


                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <div class="controls">

                                                    <vs-checkbox  v-model="status">Enable</vs-checkbox>
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
                                    <!-- users edit account form ends -->
                                </div>


                            </div>
                        </div>
                    </div>

            </section>
            <!-- users edit ends -->



        </div>
    </coupons-form>
    @push('script')


    @endpush


@stop