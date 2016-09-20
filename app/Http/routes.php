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


Route::group(['prefix' => 'portal', 'middleware' => ['auth', 'acl'], 'is' => 'business'], function () {
    Route::get('dashboard', ['uses' => 'DashboardController@index', 'as' => 'portal.dashboard']);
    Route::get('new_listing', ['uses' => 'DashboardController@new_listing', 'as' => 'portal.new_listing']);
    Route::post('new_listing_handler', ['uses' => 'DashboardController@new_listing_handler', 'as' => 'portal.new_listing_handler']);
    Route::get('edit_listing/{id}', ['uses' => 'DashboardController@edit_listing', 'as' => 'portal.edit_listing']);
    Route::post('edit_listing_handler', ['uses' => 'DashboardController@edit_listing_handler', 'as' => 'portal.edit_listing_handler']);

    Route::get('edit_profile', ['uses' => 'UserController@edit_profile', 'as' => 'portal.edit_profile']);
    Route::post('edit_profile_handler', ['uses' => 'UserController@edit_profile_handler', 'as' => 'portal.edit_profile_handler']);
});

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth', 'acl'], 'is' => 'admin'], function () {

});


Route::get('/', ['uses' => 'PagesController@frontpage', 'as' => 'frontpage']);
Route::get('c/{category}',['uses' => 'ListingCategoriesController@show', 'as' => 'listing_categories']);
Route::get('c/{category}/{slug}',['uses' => 'ListingsController@show', 'as' => 'view_listing']);
Route::get('contact', ['uses' => 'PagesController@contact', 'as' => 'contact_page']);
Route::get('{page}', ['uses' => 'PagesController@show', 'as' => 'show_page']);
Route::get('post/{post}', ['uses' => 'PostsController@show', 'as' => 'show_post']);
Route::get('categories/{category}', ['uses' => 'PostCategoriesController@show', 'as' => 'show_postcategory']);
Route::resource('users','UserController');
Route::get('results', 'ResultsController@getResults');
Route::post('search/suggest', 'AjaxController@suggest');