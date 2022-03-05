@extends('dashboard_layout.main')
@push('style')
    <style>

        #inlineForm .modal-dialog .modal-content{
            width: 700px;
        }
        @media (max-width: 576px) {
            #inlineForm .modal-dialog .modal-content{
                width: 100%;
            }
        }
        div.dataTables_wrapper div.dataTables_paginate {
            display: none !important;

        }
        .con-vs-pagination {
            margin: auto !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('admin-layout/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-layout/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('admin-layout/app-assets/css/pages/data-list-view.css')}}">

@endpush
@section('content')
    <contacts-index :messages='{{$contacts->toJson() }}'
                    inline-template>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-thumb-view" class="data-thumb-view-header">
                <div class="action-btns d-none">
                    <div class="btn-dropdown mr-1 mb-1">
                        <div class="btn-group dropdown actions-dropodown">

                            {{--<button type="button" class="btn btn-outline-primary waves-effect waves-light" @click="action">--}}
                            {{--<i class='feather icon-plus'>  @lang('lang.add')</i>--}}
                            {{--</button>--}}
                        </div>

                    </div>

                </div>

                <!-- dataTable starts -->
                <div class="table-responsive">
                    <table class="table data-thumb-view">
                        <thead>
                        <tr>
                            <th></th>
                            <th>@lang('lang.name')</th>
                            <th>@lang('lang.email')</th>
                            <th>@lang('lang.is_replay')</th>
                            <th>@lang('lang.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr  v-for="property,index in messages_all.data">
                            <td></td>
                            <td class="product-name">@{{ property.full_name }}</td>
                            <td class="product-name">@{{ property.email }}</td>
                            <td>
                                <span class="chip chip-info" style="color:white; padding: 3px 10px;" v-if="property.is_replay== 0 "> @lang('lang.waiting') </span>
                                <span class="chip chip-success" style="color:white; padding: 3px 10px;" v-if="property.is_replay==1"> @lang('lang.replay')</span>

                            </td>
                            <td class="product-action">
                                <span class="action-edit"><i class=" fa fa-reply"  @click="edit(property,index)" data-toggle="modal" data-target="#inlineForm"></i></span>
                                <span class="action-delete"><i class="feather icon-trash"  @click="deleteRecord(property.id,index)"></i></span>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    @if ( app()->getLocale()== 'en')
                        <vs-pagination   :total="messages_all.last_page"  v-model="currentx" @change="onChangePage" ></vs-pagination>
                    @else
                        <vs-pagination   :total="messages_all.last_page"  v-model="currentx" @change="onChangePage" prev-icon="chevron_right" next-icon="chevron_left" ></vs-pagination>
                        {{--{{$users->links()}}--}}
                    @endif
                </div>
                <!-- dataTable ends -->


            <!-- Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">@lang("lang.add_reply") </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="data-name">@lang("lang.name")</label>
                                        <input  readonly type="text" class="form-control"  id="full_name" v-model="full_name"  >
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="data-name">@lang("lang.email")</label>

                                        <input  readonly type="text" class="form-control"  id="email" v-model="email"  >
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-6">--}}
                                        {{--<label for="data-name">City</label>--}}

                                        {{--<input  readonly type="text" class="form-control"  id="city" v-model="city"  >--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-6">--}}
                                        {{--<label for="data-name">Phone</label>--}}

                                        {{--<input  readonly type="text" class="form-control"  id="phone" v-model="phone"  >--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="data-name">Subject</label>

                                        <input  readonly type="text" class="form-control"  id="subject" v-model="subject"  >
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top: 17px;">
                                    <vs-textarea  readonly label="@lang("lang.message")" v-model="msg"  rows="4"/>

                                </div>

                                <div class="form-group">
                                    <div>
                                        <vs-textarea label="@lang("lang.reply_message")" rows="4" v-model="replay_text"  name="replay_text"   id="replay_text"  />
                                    </div>
                                    <span v-if="form.error && form.validations.replay_text" style="color: red" >@{{ form.validations.replay_text[0] }}</span>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary"  @click="save_reply()" v-if="id">@lang("lang.send")</button>
                                <button class="btn btn-outline-danger" data-dismiss="modal"> @lang("lang.cancel")</button>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- Data list view end -->

        </div>
    </contacts-index>
    @push('script')
        {{--<script src="{{asset('admin-layout/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>--}}
        <script src="{{asset('admin-layout/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" defer></script>
        <script src="{{asset('admin-layout/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}" defer></script>
        <script src="{{asset('admin-layout/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}" defer></script>
        <script src="{{asset('admin-layout/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}" defer></script>
        <script src="{{asset('admin-layout/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}" defer></script>
        <script src="{{asset('admin-layout/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}" defer></script>
        <script>
            $(document).ready(function() {
                "use strict"

                // init thumb view datatable
                var dataThumbView = $(".data-thumb-view").DataTable({
                    responsive: false,
                    columnDefs: [
                        {
                            orderable: true,
                            targets: 0,
                            checkboxes: { selectRow: true }
                        }
                    ],
                    dom:
                        '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
                    oLanguage: {
                        sLengthMenu: "_MENU_",
                        sSearch: ""
                    },
                    aLengthMenu: [[4, 10, 15, 20], [4, 10, 15, 20]],
                    select: {
                        style: "multi"
                    },
                    order: [[1, "asc"]],
                    bInfo: false,
                    pageLength: 15,
                    buttons: [
                        {

                            action: function() {
//                                    $(this).removeClass("btn-secondary")
//                                    $(".add-new-data").addClass("show")
//                                    $(".overlay-bg").addClass("show")
                            },
//                                className: "btn-outline-primary"
                        }
                    ],
                    initComplete: function(settings, json) {
                        $(".dt-buttons .btn").removeClass("btn-secondary")
                    }
                })

                dataThumbView.on('draw.dt', function(){
                    setTimeout(function(){
                        if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                            $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
                        }
                    }, 50);
                });

                // To append actions dropdown before add new button
                var actionDropdown = $(".actions-dropodown")
                actionDropdown.insertBefore($(".top .actions .dt-buttons"))


                // Scrollbar
                if ($(".data-items").length > 0) {
                    new PerfectScrollbar(".data-items", { wheelPropagation: false })
                }

//                    // Close sidebar
                $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
                    $(".add-new-data").removeClass("show")
                    $(".overlay-bg").removeClass("show")
                    $("#data-name, #data-price").val("")
                    $("#data-category, #data-status").prop("selectedIndex", 0)
                })


                // mac chrome checkbox fix
                if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                    $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
                }
            })



        </script>
        <!-- END: Page JS-->

    @endpush

@stop