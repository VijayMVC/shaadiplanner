<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Auth;
Route::auth();


Route::group(['prefix' => 'portal', 'middleware' => ['auth', 'acl','XSS'], 'is' => 'business'], function () {
    Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'portal.dashboard']);
    Route::get('listings', ['uses' => 'DashboardController@listings', 'as' => 'portal.listings']);
    Route::get('new_listing', ['uses' => 'DashboardController@new_listing', 'as' => 'portal.new_listing']);
    Route::post('new_listing_handler', ['uses' => 'DashboardController@new_listing_handler', 'as' => 'portal.new_listing_handler']);
    Route::get('edit_listing/{id}', ['uses' => 'ListingsController@edit', 'as' => 'portal.edit_listing']);
    Route::post('edit_listing/{id}', ['uses' => 'ListingsController@update', 'as' => 'portal.edit_listing_handler']);
    Route::get('add_listing', ['uses' => 'ListingsController@create', 'as' => 'portal.add_listing']);
    Route::post('add_listing', ['uses' => 'ListingsController@store', 'as' => 'portal.add_listing_handler']);
    Route::get('edit_profile', ['uses' => 'UserController@edit_profile', 'as' => 'portal.edit_profile']);
    Route::post('edit_profile_handler', ['uses' => 'UserController@edit_profile_handler', 'as' => 'portal.edit_profile_handler']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'acl'], 'is' => 'administrator'], function () {
    Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard']);
    Route::get('listings', ['uses' => 'DashboardController@listings', 'as' => 'admin.listings']);
    Route::resource('users','UserController');
    Route::get('new_listing', ['uses' => 'DashboardController@new_listing', 'as' => 'admin.new_listing']);
    Route::post('new_listing_handler', ['uses' => 'DashboardController@new_listing_handler', 'as' => 'admin.new_listing_handler']);
    Route::get('edit_listing/{id}', ['uses' => 'ListingsController@edit', 'as' => 'admin.edit_listing']);
    Route::post('edit_listing/{id}', ['uses' => 'ListingsController@update', 'as' => 'admin.edit_listing_handler']);
    Route::get('add_listing', ['uses' => 'ListingsController@create', 'as' => 'admin.add_listing']);
    Route::post('add_listing', ['uses' => 'ListingsController@store', 'as' => 'admin.add_listing_handler']);
});

Route::group(['middleware' => ['auth', 'acl'], 'is' => 'member'], function () {

});

Route::post('favourite',['uses' => 'ListingsController@addFavourite', 'as' => 'favourite']);

Route::get('/', ['uses' => 'PagesController@frontpage', 'as' => 'frontpage']);
Route::get('c/{category}',['uses' => 'ListingCategoriesController@show', 'as' => 'listing_categories']);
Route::get('c/{category}/{slug}',['uses' => 'ListingsController@show', 'as' => 'view_listing']);
Route::get('contact', ['uses' => 'PagesController@contact', 'as' => 'contact_page']);
Route::get('{page}', ['uses' => 'PagesController@show', 'as' => 'show_page']);
Route::get('post/{post}', ['uses' => 'PostsController@show', 'as' => 'show_post']);
Route::get('categories/{category}', ['uses' => 'PostCategoriesController@show', 'as' => 'show_postcategory']);

Route::get('results', 'ResultsController@getResults');
Route::post('search/suggest', 'AjaxController@suggest');