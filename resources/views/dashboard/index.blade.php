@extends('dashboard_layout.main')
@section('content')
    <div class="row">
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-server text-info font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">{{$category}}</h2>
                        <p class="mb-0 line-ellipsis">Category</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-plus-square text-warning font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">{{$entrees}}</h2>
                        <p class="mb-0 line-ellipsis">Entrees</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-box text-danger font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">{{$product}}</h2>
                        <p class="mb-0 line-ellipsis">Products</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-grid text-primary font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">{{$ingredient}}</h2>
                        <p class="mb-0 line-ellipsis">Ingredient</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                            <div class="avatar-content">
                                <i class="feather icon-mail text-success font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700">{{$messages}}</h2>
                        <p class="mb-0 line-ellipsis">Messages</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@stop