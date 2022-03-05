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
    </style>

@endpush
@section('content')
    <product-form
            :products='{!!  isset($product) ? $product : 'null' !!}'
            :categories='{!!  isset($category) ? $category : 'null' !!}'
            :days='{!!  isset($day) ? $day : 'null' !!}'
            :ingredients='{!!  isset($ingredient) ? $ingredient : 'null' !!}'
            :products_extra='{!!  isset($product) ? $product->extras : 'null' !!}'
            :product_size='{!!  isset($product) ? $product->sizes : 'null' !!}'
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
                                        <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Add Product</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                        <i class="feather icon-share-2 mr-25"></i><span class="d-none d-sm-block"> Add Extras</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="size-tab" data-toggle="tab" href="#size" aria-controls="size" role="tab" aria-selected="false">
                                        <i class="feather icon-share-2 mr-25"></i><span class="d-none d-sm-block"> Add Size</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="entrees-tab" data-toggle="tab" href="#entrees" aria-controls="entrees" role="tab" aria-selected="false">
                                        <i class="feather icon-share-2 mr-25"></i><span class="d-none d-sm-block"> Add Entrees To Products</span>
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
                                                    <label>Category</label>
                                                    <div>
                                                        <v-select  label="name" dir="ltr" v-model="category_id" :options="categories" :dir="$vs.rtl ? 'rtl' : 'ltr'"  />
                                                    </div>
                                                    <span v-if="form.error && form.validations.category_id" style="color: red">@{{ form.validations.category_id[0] }}</span>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Ingredients</label>
                                                    {{--<div>--}}
                                                    {{--<vue-tags-input--}}
                                                    {{--v-model="ingredient"--}}
                                                    {{--:tags="ingredients"--}}
                                                    {{--placeholder="Add Ingredients"--}}
                                                    {{--@tags-changed="update"--}}
                                                    {{--/>--}}
                                                    {{--</div>--}}
                                                    <div>
                                                        <v-select  label="name" dir="ltr" v-model="ingredient" :options="ingredients" :dir="$vs.rtl ? 'rtl' : 'ltr'" multiple />
                                                    </div>
                                                    <span v-if="form.error && form.validations.ingredient" style="color: red">@{{ form.validations.ingredient[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Days Available</label>
                                                    <div>
                                                        <v-select  label="name" dir="ltr" v-model="day" :options="days" :dir="$vs.rtl ? 'rtl' : 'ltr'"  multiple/>
                                                    </div>
                                                    <span v-if="form.error && form.validations.day" style="color: red">@{{ form.validations.day[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Price</label>
                                                    <input type="text" class="form-control"  v-model="price"  id="price" name="price">
                                                    <span v-if="form.error && form.validations.price" style="color: red">@{{ form.validations.price[0] }}</span>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="controls">
                                                    <label>Product Description </label>
                                                    <textarea class="form-control" id="description" rows="5" v-model="description"   name="description"></textarea>
                                                    <span v-if="form.error && form.validations.description" style="color: red">@{{ form.validations.description[0] }}</span>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-6">

                                            <div class="controls" style="text-align: center;">
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h5>Product Image</h5>
                                                        <div class="upload-photo" >

                                                            <div class="con-img-upload" >
                                                                <div  class="img-upload"  style="margin: 20px auto" v-if="image" >
                                                                    <button @click="removeImage(0)" type="button" class="btn-x-file">
                                                                        <i translate="translate" class="material-icons notranslate"> clear </i>
                                                                    </button>
                                                                    <img :src="image_url" style="max-width: none; max-height: 100%;">
                                                                </div>
                                                            </div>
                                                            <div class="upload-photo" v-if="!image">
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
                                                            <span v-if="form.error && form.validations.image" style="color: red">@{{ form.validations.image[0] }}</span>

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
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="mb-0"> Extras</h4>
                                                </div>
                                                <div class="card-content">
                                                    <div class="table-responsive mt-1">
                                                        <table class="table table-hover-animation mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>Extra Name</th>
                                                                <th>Price</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr v-for="(extra, index) in extras">

                                                                <td><input  type="text" class="form-control" style="width: 60%;" v-model="extra.name"></td>
                                                                <td><input type="text" class="form-control" style="width: 60%;" v-model="extra.price"></td>
                                                                <td><i class="feather icon-trash"  @click="deleteItem(extra)" ></i></td>
                                                            </tr>

                                                            </tbody>


                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <button  class="btn btn-outline-danger"  @click="addItem()">Add New Extra
                                            </button>
                                        </div>

                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                            <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" @click="save()">@lang('lang.Saved_change')
                                            </button>
                                            <button type="reset" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                        </div>
                                    </div>

                                    <!-- users edit socail form ends -->

                                </div>
                                <div class="tab-pane" id="size" aria-labelledby="size-tab" role="tabpanel">
                                    <!-- users edit socail form start -->

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="mb-0"> Add Pizza Size</h4>
                                                </div>
                                                <div class="card-content">
                                                    <div class="table-responsive mt-1">
                                                        <table class="table table-hover-animation mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>Size</th>
                                                                <th>Price</th>
                                                                <th style="text-align: center;" >Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr v-for="(size, index) in sizes">

                                                                <td><input   class="form-control"  style="width: 90%;" v-model="size.size"/></td>
                                                                <td><input   class="form-control"  style="width: 90%;" v-model="size.price"/></td>
                                                                <td>
                                                                    <div class="upload-photo" >

                                                                        <div class="con-img-upload"  >
                                                                            <div  class="img-upload"  style="margin: 20px auto" v-if="size.image" >
                                                                                <button @click="remove(index)" type="button" class="btn-x-file">
                                                                                    <i translate="translate" class="material-icons notranslate"> clear </i>
                                                                                </button>
                                                                                <img :src="size.image_url" style="max-width: none; max-height: 100%;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="upload-photo" v-if="!size.image">
                                                                            <div class="con-upload" >
                                                                                <div class="con-img-upload"  >
                                                                                    <div class="con-input-upload" style="margin: 20px auto" @click="toggleFileManagerSidebar(true,2,index)">
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
                                                                </td>
                                                                <td><i class="feather icon-trash"  @click="deleteItems(index)" ></i></td>
                                                            </tr>

                                                            </tbody>


                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <button  class="btn btn-outline-danger"  @click="addItems()">Add New Size
                                            </button>
                                        </div>

                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                            <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" @click="save()">@lang('lang.Saved_change')
                                            </button>
                                            <button type="reset" class="btn btn-outline-warning">@lang('lang.cancel')</button>
                                        </div>
                                    </div>

                                    <!-- users edit socail form ends -->

                                </div>
                                <div class="tab-pane" id="entrees" aria-labelledby="entrees-tab" role="tabpanel">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a href="app-ecommerce-details.html">
                                                <img src="{{asset('admin-layout/app-assets/images/pages/eCommerce/1.png')}}" class="img-fluid" alt="img-placeholder">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div class="badge badge-primary badge-md">
                                                        4 <i class="feather icon-star ml-25"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="item-price">
                                                        $19.99
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="item-name">
                                                <a href="app-ecommerce-details.html">
                                                    Sony - ZX Series On-Ear Headphones - Black
                                                </a>
                                            </div>
                                            <div>
                                                <p class="item-description">
                                                    These Sony ZX Series MDRZX110/BLK headphones
                                            </div>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="wishlist remove-wishlist">
                                                <i class="feather icon-x align-middle"></i> Remove
                                            </div>
                                            <div class="cart move-cart">
                                                <i class="feather icon-shopping-cart"></i> <span class="add-to-cart">Move to cart</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->



        </div>
    </product-form >
    @push('script')
        <script src="{{asset('admin-layout/app-assets/js/scripts/pages/app-ecommerce-shop.js')}}"></script>

    @endpush


@stop