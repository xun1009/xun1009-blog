<?php

Route::get('/','HomeController@index')->name('backend.home');

Route::resource('article','ArticleController');

Route::resource('category','CategoryController');

Route::resource('tag','TagController');

Route::get('/setting/user','SettingController@userShow')->name('setting.user');

Route::post('/setting/user','SettingController@userUpdate')->name('setting.user.update');

Route::get('/setting/website','SettingController@website')->name('setting.website');

Route::post('/setting/website','SettingController@websiteUpdate')->name('setting.website.update');


Route::post('/user/avatar','SettingController@changAvatar');

Route::get('/user','UserController@index')->name('user');


Route::get('/addRole','RoleController@addRole');