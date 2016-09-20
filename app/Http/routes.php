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


Route::group(['namespace' => 'business', 'prefix' => 'portal', 'middleware' => ['auth', 'acl'], 'is' => 'business'], function () {

});

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth', 'acl'], 'is' => 'admin'], function () {

});


Route::get('/', ['uses' => 'PagesController@frontpage', 'as' => 'frontpage']);
Route::resource('business','BusinessController');
Route::get('contact', ['uses' => 'PagesController@contact', 'as' => 'contact_page']);
Route::get('{page}', ['uses' => 'PagesController@show', 'as' => 'show_page']);
Route::get('post/{post}', ['uses' => 'PostsController@show', 'as' => 'show_post']);
Route::get('categories/{category}', ['uses' => 'PostCategoriesController@show', 'as' => 'show_postcategory']);
Route::resource('users','UserController');
Route::get('results', 'ResultsController@getResults');
Route::post('search/suggest', 'AjaxController@suggest');