<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('/', ['as' => 'index', 'uses'=> 'BlogController@getBlog']);
    Route::get('/{slug}', ['as' => 'post', 'uses' => 'BlogController@getBlogPost']);
});

Route::group(['prefix' => 'backend/blog', 'as' => 'backend.blog.' ,'middleware' => 'auth:web'], function(){
    Route::resource('/posts', 'PostController', ['except' => 'show']);
    Route::get('/{post}/confirm', ['as' => 'posts.confirm', 'uses' => 'PostController@confirm']);
});
