<?php

// Route::resource('test', 'TestController');

// Route::post('/order', 'SiteController@order');
Route::get('/loadlove', 'SiteController@loadlove');
Route::get('/unlove', 'SiteController@unlove');
Route::get('/love', 'SiteController@love');
Route::post('/contact', 'SiteController@contact');
Route::get('/sitemap.xml', 'SiteController@sitemap');
Route::get('/tim-kiem', ['uses' => 'SiteController@search', 'as' => 'site.search']);
Route::get('/', ['uses' => 'SiteController@index', 'as' => 'site.index']);
Route::get('tag/{slug}', ['uses' => 'SiteController@tag', 'as' => 'site.tag']);
Route::get('{slug1}/{slug2}', 'SiteController@page2');
Route::get('{slug}', 'SiteController@page');