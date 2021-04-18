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

Route::get('/','FrontController@index');
Route::get('/services','FrontController@services');
Route::get('category/services/{id}','FrontController@catServices');
Route::get('/about','FrontController@about');
Route::get('/testimonial','FrontController@testimonial');
Route::get('/contact','FrontController@contact');

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin','middleware' => ['auth', 'admin']], function() {

    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

    // banner image for admin
    Route::resource('banner', 'BannerImageController');
    Route::get('banner', 'BannerImageController@index')->name('bannerImages');
    Route::resource('/add-banner', 'BannerImageController@store');
    Route::post('banner/delete/{id}', 'BannerImageController@destroy')->name('banner.delete');
    Route::get('banner/edit/{id}', 'BannerImageController@edit')->name('banner.edit');
    Route::any('banner/update/{id}', 'BannerImageController@update');
    Route::any('add-banner-image','BannerImageController@create');

    // Route::resource('service/categories', 'CategoryController');
    Route::get('/service/categories', 'CategoryController@index')->name('categories');
    Route::get('service-categories', 'CategoryController@create');
    Route::post('service-categories/store', 'CategoryController@store');
    Route::any('service-categories/edit/{id}', 'CategoryController@edit')->name('edit.category');
    Route::post('service-categories/update/{id}', 'CategoryController@update');
    Route::post('service-categories/delete/{id}', 'CategoryController@destroy')->name('delete.category');
    Route::get('service', 'CategoryController@getData')->name('productCategories');


    //product sub category
    Route::resource('service/subcat', 'SubCategoryController');
    Route::get('service/subcat', 'SubCategoryController@index')->name('subcategories');
    Route::get('service-subcat', 'SubCategoryController@create')->name('subcategory.create');
    Route::any('service-subcat/delete/{id}', 'SubCategoryController@destroy')->name('subcategory.delete');

    //show subcategories of category
    Route::get('category-subcat-details/{id}','SubCategoryController@showCatSubcat')->name('view.subcat');

    //admin CRUD of Services
    Route::post('delete/service/{id}', 'ServicesController@destroy')->name('delete.service');
    Route::any('add/service', 'ServicesController@create');
    Route::get('edit/service/{id}', 'ServicesController@edit')->name('edit.service');
    Route::any('update/service/{id}', 'ServicesController@update');
    Route::any('add-service', 'ServicesController@store');
    Route::get('service', 'ServicesController@index')->name('service.index');

    //admin CRUD of Service Providers
    Route::post('delete/service-provider/{id}', 'ServiceProviderController@destroy')->name('delete.service-provider');
    Route::any('add/service-provider', 'ServiceProviderController@create');
    Route::get('edit/service-provider/{id}', 'ServiceProviderController@edit')->name('edit.service-provider');
    Route::any('update/service-provider/{id}', 'ServiceProviderController@update');
    Route::any('add-service-provider', 'ServiceProviderController@store');
    Route::get('service-provider', 'ServiceProviderController@index')->name('service-provider.index');

    //routes for Testimonials
    Route::get('testimonials', 'TestimonialController@index')->name('view.testimonial');
    Route::get('add/testimonial', 'TestimonialController@create')->name('add.testimonial');
    Route::post('store/testimonial', 'TestimonialController@store')->name('store.testimonial');
    Route::get('edit/testimonial/{id}', 'TestimonialController@edit')->name('edit.testimonial');
    Route::post('update/testimonial/{id}', 'TestimonialController@update')->name('update.testimonial');
    Route::post('delete/testimonial/{id}', 'TestimonialController@destroy')->name('delete.testimonial');

    Route::get('edit/service/requests/{id}','HomeController@editServiceRequest')->name('edit.service-requests');
    Route::any('update/service/requests/{id}','HomeController@updateServiceRequest')->name('update.service-requests');
    Route::post('delete/service/requests/{id}', 'HomeController@destroy')->name('servicerequests.delete');
    Route::get('settings','AdminController@viewSettings');
});
Route::group(['prefix' => 'customer','middleware' => 'auth'], function() {
    Route::get('/','CustomerController@index')->name('customer.index');
    Route::get('register/service/{sid}', 'CustomerController@registerService');
    Route::get('view/service/requests/{id}', 'CustomerController@viewServiceRequests');
    Route::get('view/completed/services', 'CustomerController@viewCompletedServices');
    Route::post('register/service','CustomerController@finalServiceRegister');
    Route::get('settings','CustomerController@viewSettings');
    Route::get('change_password', 'ChangeCustomerPasswordController@showChangePasswordForm')->name('customer.change_password');
    Route::patch('change_password', 'ChangeCustomerPasswordController@changePassword')->name('customer.change_password');

    Route::get('reviews', 'TestimonialController@index')->name('view.testimonial');
    Route::get('add/review', 'TestimonialController@create')->name('add.testimonial');
    Route::post('store/review', 'TestimonialController@store')->name('store.testimonial');
    Route::get('edit/review/{id}', 'TestimonialController@edit')->name('edit.testimonial');
    Route::post('update/review/{id}', 'TestimonialController@update')->name('update.testimonial');
    Route::post('delete/review/{id}', 'TestimonialController@destroy')->name('delete.testimonial');
});


Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
