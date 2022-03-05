@extends('dashboard_layout.main')
@push('style')
    <style>

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
    <day-index
            :days='{{ $day->toJson() }}'
            inline-template>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-thumb-view" class="data-thumb-view-header">
                <div class="action-btns d-none">
                    <div class="btn-dropdown mr-1 mb-1">
                        <div class="btn-group dropdown actions-dropodown">
                            <button type="button" class="btn btn-outline-primary waves-effect waves-light" @click="action">
                                <i class='feather icon-plus'>  @lang('lang.add')</i>
                            </button>
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
                            <th>@lang('lang.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr  v-for="property,index in days_all.data" :id="property.id">
                            <td></td>
                            <td class="product-name">@{{ property.name }}</td>
                            <td class="product-action">
                                <span class="action-edit"><i class="feather icon-edit"  @click="edit(property,index)"></i></span>
                                <span class="action-delete"><i class="feather icon-trash"  @click="deleteRecord(property.id,index)"></i></span>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <vs-pagination   :total="days_all.last_page"  v-model="currentx" @change="onChangePage" ></vs-pagination>


                </div>
                <!-- dataTable ends -->

                <!-- add new sidebar starts -->
                <div class="add-new-data-sidebar">
                    <div class="overlay-bg"></div>
                    <div class="add-new-data" id="add-new-data">
                        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                            <div>
                                <h4 class="text-uppercase" v-if="id">@lang('lang.edit_item')</h4>
                                <h4 class="text-uppercase" v-else>@lang('lang.add_new_item')</h4>

                            </div>
                            <div class="hide-data-sidebar">
                                <i class="feather icon-x"></i>
                            </div>
                        </div>
                        <div class="data-items pb-3">
                            <div class="data-fields px-2 mt-3">
                                <div class="row">

                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">@lang('lang.name')</label>
                                        <input type="text" class="form-control" id="name" v-model="name">
                                        <span v-if="form.error && form.validations.name" style="color: red">@{{ form.validations.name[0] }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button class="btn btn-primary"  @click="save()" v-if="id">@lang('lang.edit')</button>
                                <button class="btn btn-primary"  @click="save()"v-else="">@lang('lang.add')</button>
                            </div>
                            <div class="cancel-data-btn">
                                <button class="btn btn-outline-danger">@lang('lang.cancel')</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add new sidebar ends -->
            </section>
            <!-- Data list view end -->

        </div>
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
    </day-index>
@stop