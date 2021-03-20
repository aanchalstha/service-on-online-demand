<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ConsultingUsersController;


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


Route::get('/', function () {
    return view('welcome');
});

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

    Route::get('view-details/{id}', 'ZoomClassesFormController@viewDetails')->name('form.index');
    Route::post('delete/form/{id}', 'ZoomClassesFormController@destroy')->name('delete.form');
    //product sub category
    Route::resource('service/subcat', 'SubCategoryController');
    Route::get('service/subcat', 'SubCategoryController@index')->name('subcategories');
    Route::get('service-subcat', 'SubCategoryController@create')->name('subcateggory.create');
    Route::post('service-subcat/delete/{id}', 'SubCategoryController@destroy');

    //show subcategories of category
    Route::get('category-subcat-details/{id}','SubCategoryController@showCatSubcat')->name('view.subcat');


    //admin CRUD of Course Authors
    Route::post('delete/author/{id}', 'AuthorController@destroy')->name('delete.author');
    Route::any('add/author', 'AuthorController@create');
    Route::get('edit/author/{id}', 'AuthorController@edit')->name('edit.author');
    Route::any('update/author/{id}', 'AuthorController@update');
    Route::any('add-author', 'AuthorController@store');
    Route::get('authors', 'AuthorController@index')->name('author.index');

    //routes for Testimonials
    Route::get('testimonials', 'TestimonialController@index')->name('view.testimonial');
    Route::get('add/testimonial', 'TestimonialController@create')->name('add.testimonial');
    Route::post('store/testimonial', 'TestimonialController@store')->name('store.testimonial');
    Route::get('edit/testimonial/{id}', 'TestimonialController@edit')->name('edit.testimonial');
    Route::post('update/testimonial/{id}', 'TestimonialController@update')->name('update.testimonial');
    Route::post('delete/testimonial/{id}', 'TestimonialController@destroy')->name('delete.testimonial');

    //routes for blog
    Route::get('blog', 'BlogController@index');
    Route::get('blog/new-post', 'BlogController@create');
    Route::post('blog/new-post', 'BlogController@store')->name('blog.store');
    Route::get('blog/edit/{slug}', 'BlogController@edit')->name('blog.edit');
    Route::post('blog/update', 'BlogController@update')->name('blog.update');
    Route::post('blog/delete/{id}', 'BlogController@destroy')->name('blog.delete');
    Route::any('/blog-getdata','BlogController@getData')->name('blogData');

    //routes of roles
    Route::get('role-register','RolesModelController@index')->name('roles.view');
    Route::get('role-getdata','RolesModelController@getData')->name('rolesData');
    Route::get('role-register/add','RolesModelController@create')->name('roles.create');
    Route::post('role-register/store','RolesModelController@store')->name('roles.store');
    Route::get('role-register/edit/{id}','RolesModelController@edit')->name('roles.edit');
    Route::get('role-register/view/{id}','RolesModelController@view')->name('roles.permissions');
    Route::post('role-register/update','RolesModelController@update')->name('roles.update');
    Route::post('role-register/delete/{id}','RolesModelController@destroy')->name('roles.delete');

    //routes of rights
    Route::get('rights-register','RightsController@index')->name('rights.view');
    Route::get('rights-getdata','RightsController@getData')->name('rightsData');
    Route::get('rights-register/add','RightsController@create')->name('rights.create');
    Route::any('rights-register/store','RightsController@store')->name('rights.store');
    Route::get('rights-register/edit/{id}','RightsController@edit')->name('rights.edit');
    Route::post('rights-register/update','RightsController@update')->name('rights.update');
    Route::post('rights-register/delete/{id}','RightsController@destroy')->name('rights.delete');


    //routes of users
    Route::get('users',[UsersController::class,'index'])->name('users.index');
    Route::get('users/view/{id}',[UsersController::class,'show'])->name('users.view');
    Route::get('users-data',[UsersController::class,'getData'])->name('users.getData');
    Route::get('users/add',[UsersController::class,'create'])->name('users.create');
    Route::post('users/add/data',[UsersController::class,'store'])->name('users.store');
    Route::get('users/edit/{id}',[UsersController::class,'edit'])->name('users.edit');
    Route::post('users/update/{id}',[UsersController::class,'update'])->name('users.update');
    Route::post('users/delete/{id}',[UsersController::class,'destroy'])->name('users.delete');

    //routes for admin settings
    Route::get('settings','AdminController@viewSettings');
});
Route::group(['prefix' => 'customer','middleware' => 'auth'], function() {
    Route::get('/','CustomerController@index');
});


