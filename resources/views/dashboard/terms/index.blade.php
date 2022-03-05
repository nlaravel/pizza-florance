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
        .ql-editor{
            height :300px !important;
        }
    </style>

@endpush
@section('content')
    <terms-index :terms='{{$terms->toJson()}}' inline-template>
        <div>


            <!-- users edit start -->
            <section class="users-edit">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                        <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">Terms & Conditions </span>
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->

                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->

                                    <div class="form-group">
                                        <div class="controls">
                                            <div class="controls">

                                                <label style="margin-bottom:20px; margin-top:20px;">Description </label>
                                                <quill-editor    v-model="description" ></quill-editor>
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
                </div>
            </section>
            <!-- users edit ends -->



        </div>
    </terms-index>
    @push('script')


    @endpush


@stop