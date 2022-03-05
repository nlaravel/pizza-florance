<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'FrontController@index')->name('front.index');
Route::get('/contact_us', 'FrontController@contact_us')->name('front.contact_us');
Route::post('/contactUs', 'FrontController@storeContactUs')->name('front.storeContactUs');
Route::get('/terms_conditions', 'FrontController@terms_conditions')->name('front.terms_conditions');
Route::get('/product/category/{id}', 'FrontController@product_category')->name('front.product_category');
Route::get('/build_your_pizza', 'FrontController@build_your_pizza')->name('front.build_your_pizza');
Route::get('/build_your_calzone', 'FrontController@build_your_calzone')->name('front.build_your_calzone');
Route::post('/order_build_your_pizza', 'FrontController@order_build_your_pizza')->name('front.order_build_your_pizza');
Route::get('/product', 'CartController@product')->name('product');
Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::get('/category_product/{id}', 'CartController@category_product')->name('cart.category_product');
Route::post('/add', 'CartController@add')->name('cart.store');
Route::post('/addToCart', 'CartController@addToCart')->name('cart.addToCart');
Route::post('/addspecial', 'CartController@addspecial')->name('cart.addspecial');
Route::post('/addCalzoneSpecial', 'CartController@addCalzoneSpecial')->name('cart.add_calzone_special');
Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
Route::post('/cart/apply-coupon','CartController@applyCoupon')->name('cart.applyCoupon');
Route::get('/checkout','FrontController@checkout')->name('cart.checkout');
Route::post('/cart/save_order','FrontController@save_order')->name('cart.save_order');
Route::post('/cart/pickup','FrontController@pickup')->name('cart.pickup');
Route::post('/cart/delivery','FrontController@delivery')->name('cart.delivery');

Route::get('/getAllCityForZipCode/{city}', 'FrontController@getAllCityForZipCode');

Route::get('/markAsRead', function (App\User $user) {
    $user = App\User::find(4);
   // dd($user->notification);
    foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
    }
    return redirect('dashbodrd.index');

});

Route::prefix('dashboard')->group(function () {

        Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::resource('user', 'UserController');
            Route::resource('setting', 'SettingController');
            Route::resource('about_us', 'AboutUsController');
            Route::resource('contact', 'ContactusController');
            Route::resource('product', 'ProductController');
            Route::resource('category', 'CategoryController');
            Route::resource('pizza_category', 'PizzaCategoryController');
            Route::resource('calzone_size', 'CalzoneSizeController');
            Route::resource('calzone_category', 'CalzoneCategoryController');
            Route::resource('pizza_size', 'PizzaSizeController');
            Route::resource('day', 'DayController');
            Route::resource('ingredient', 'IngredientController');
            Route::get('/profile', 'UserController@getUserInformation')->name('profile.index');
            Route::post('/profile', 'UserController@storeUserInformation')->name('storeUserInformation');
            Route::post('/fileManger/uploader', 'FileMangerController@uploader');
            Route::get('fileMangerPage', 'FileMangerController@fileMangerPage')->name('fileMangerPage');
            Route::resource('fileManger', 'FileMangerController');
            Route::resource('terms', 'TermsController');
            Route::resource('entrees', 'EntreesController');
            Route::resource('topping', 'ToppingController');
            Route::resource('coupon', 'CouponsController');
            Route::resource('payment', 'PaymentMethodsController');
            Route::resource('state', 'StateController');
            Route::resource('city', 'CityController');
            Route::resource('order', 'OrderController');
            Route::delete('product_entress/{id}', 'ProductController@product_entress');
    });
});
Auth::routes();
// Clear view cache:
Route::get('/view-clear', function() {
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    return 'View cache cleared';
});
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/test', function() {
//    dd(\App\Product::first()->categories->add_size != 1);
//});