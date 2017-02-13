<?php

Route::get('/blog', 'BlogController@getBlog')->name('blog.index');
Route::get('/blog/{slug}', 'BlogController@getBlogPost')->name('blog.post');
Route::resource('backend/blog', 'BlogController', ['as' => 'backend', 'except' => 'show']);
Route::get('backend/blog/{blog}/confirm', ['as' => 'backend.blog.confirm', 'uses' => 'BlogController@confirm']);
