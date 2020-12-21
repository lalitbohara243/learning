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

Auth::routes(['verify' => true]);

Route::get ( '/redirect/{service}', 'SocialAuthController@redirect' );
Route::get('sendmail','MailController@index');

Route::get ( '/callback/{service}', 'SocialAuthController@callback' );
Route::group(['prefix' => 'admin','middleware' => ['auth'] ],function() {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoryController');
    Route::post('categories/subcategory', 'CategoryController@subcategory')->name('categories.subcategory');
    Route::post('subcategories/attributes', 'SubCategoryController@attribute')->name('sub_categories.attribute');
    Route::resource('subCategories', 'SubCategoryController');
    Route::resource('attributes', 'AttributeController');
    Route::resource('products', 'ProductController');
    Route::resource('cities', 'CityController');
    Route::get('approved-products', 'ProductController@approved')->name('products.approved');
    Route::get('product/approved/{product_id}/{user_id}/{status}', 'ProductController@approval')->name('product.approval');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('users', 'UserController');
    Route::get('profile/index','ProfileController@index')->name('profile.index');
    Route::get('change_password','ProfileController@changePassword')->name('profile.change_password');
    Route::post('store_password','ProfileController@storePassword')->name('profile.store_password');
    Route::get('profile/edit/{id}','ProfileController@edit')->name('profile.edit');
    Route::post('profile/update/{id}','ProfileController@update')->name('profile.update');
});






Route::group([ 'namespace' => 'Web','as' => 'web.'],function() {
    Route::get('/','HomeController@index')->name('home');
    Route::get('login-register', 'LoginController@login_form')->name('login-register');
    Route::post('user/login','LoginController@login')->name('login');
    Route::post('user/register','LoginController@store')->name('register');
    Route::get('user/logout','LoginController@logout')->name('logout');
    Route::get('allproducts/{cat_slug}','ProductController@index')->name('products.index');
    Route::get('product/{slug}','ProductController@show')->name('product.show');
    Route::get('change/status/{product_code}','ProductController@changeStatus')->name('product.status');
    Route::get('profile', 'AccountController@index')->name('my-profile');
    Route::post('edit-account','AccountController@update')->name('edit-account');
    Route::get('change-password','AccountController@changePassword')->name('change-password');
    Route::post('update-password','AccountController@updatePassword')->name('update-password');
    Route::get('cart/add/{product_code}','CartController@add')->name('cart.add');
    Route::get('cart','CartController@index')->name('cart.index');
    Route::get('update/cart','CartController@update')->name('cart.update');
    Route::get('delete/cart/{id}','CartController@delete')->name('cart.delete');
    Route::get('verified-email', 'LoginController@verified')->name('email.verified');
    Route::get ( '/redirect/{service}', 'SocialAuthController@redirect' );
    Route::get ( '/callback/{service}', 'SocialAuthController@callback' );
    Route::post ( 'social-register', 'SocialAuthController@register' )->name('social-register');
    Route::post('review/store','ReviewController@store')->name('review.store');
    Route::post('review/update/{id}','ReviewController@update')->name('review.update');
    Route::get('delete/review/{id}','ReviewController@delete')->name('review.delete');
    Route::get('drafts','MyProductController@Draft')->name('draft.myproducts');
    Route::get('myproducts','MyProductController@myProduct')->name('myproduct');
    Route::get('orders','MyProductController@Orders')->name('orders');

    Route::get('add/product','MyProductController@category')->name('product.category')->middleware('verified');

    Route::get('add/product/{slug}','MyProductController@add')->name('product.add')->middleware('verified');

    Route::post('save/product','MyProductController@save')->name('product.save')->middleware('verified');
    Route::get('myproducts/{slug}','MyProductController@edit')->name('myproduct.edit');
    Route::get('myproducts/{slug}/edit','MyProductController@edit')->name('myproducts.edit');
    Route::patch('myproducts/{slug}','MyProductController@update')->name('myproducts.update');
    Route::get('delete/myproducts/{slug}','MyProductController@destroy')->name('myproducts.destroy');


    Route::get('myproducts/photos/{slug}','MyProductController@photo_manager')->name('myproducts.photo');
    Route::get('sendrequest/myproducts/{slug}','MyProductController@requestView')->name('myproducts.request');
    Route::get('sendrequest/{slug}','MyProductController@sendRequest')->name('myproducts.send');
    Route::post('upload','PhotoController@upload')->name('photo.image');
    Route::post('upload/delete','PhotoController@delete')->name('photo.delete');
    Route::get('upload/destroy/{data}','PhotoController@destroy')->name('photo.destroy');
    Route::get('notification/{id}','HomeController@Notification')->name('notification');
    Route::get('recommendation','RecommendationController@index')->name('recommend.index');
    Route::get('get/cart/{type}','OrderController@cartSession')->name('order.session');
    Route::get('update/session/order','OrderController@updateSession')->name('order.update.session');
    Route::get('checkout','OrderController@checkout')->name('order.checkout');

    Route::get('order/status','OrderController@changeStatus')->name('order.status');
    Route::post('order/create','OrderController@create')->name('order.create');
    Route::post('shipping/add','ShippingController@add')->name('shipping.add');
    Route::post('shipping/{id}/update','ShippingController@update')->name('shipping.update');
});

