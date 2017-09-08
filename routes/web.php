<?php

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/check_email','EmailController@checkEmail');

Route::get('/email/verify/{token}','EmailController@verify')->name('email.verify');

Route::get('/github/callback','Auth\LoginController@githubCallback');

Route::get('/github/login','Auth\LoginController@github')->name('github.login');

//前端路由

Route::get('/article','ArticleController@index')->name('front.article');

Route::get('/article/{article}','ArticleController@show')->name('front.article.show');

Route::get('/tag','TagController@index')->name('front.tag');

Route::get('/tag/{name}','TagController@show')->name('front.tag.show');

Route::get('/category','CategoryController@index')->name('front.category');

Route::get('/category/{category}','CategoryController@show')->name('front.category.show');

Route::get('/user/{name}','HomeController@user')->name('front.user');

Route::get('/search','ArticleController@search')->name('article.search');

Route::get('/comment','CommentController@index');