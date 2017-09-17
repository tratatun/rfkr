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

// Public pages
Route::get('/', 'MainController@index');
Route::get('/agree', 'MainController@agree');
Route::get('/treatment', 'MainController@treatment');
Route::get('/search', 'MainController@search');

// Admin pages (private pages)
Route::get('/admin', 'Admin\DefaultController@index');

Route::get('/admin/pages', 'Admin\PagesController@index')->name('admin.pages');
Route::get('/admin/pages/create', 'Admin\PagesController@create')->name('admin.pages.create');

Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');
Route::get('/admin/users/create', 'Admin\UsersController@create')->name('admin.users.create');
Route::get('/admin/users/{user}/edit', 'Admin\UsersController@edit')->name('admin.users.edit');
Route::post('/admin/users', 'Admin\RegisterController@register');
Route::post('/admin/users/{user}', 'Admin\UsersController@update')->name('admin.users.update');

Route::get('/admin/treatments', 'Admin\TreatmentsController@index')->name('admin.treatments');
Route::get('/admin/treatments/answer', 'Admin\TreatmentsController@answerTreatment');
Route::get('/admin/treatments/review', 'Admin\TreatmentsController@reviewTreatment');


Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\LoginController@login');

Route::get('/admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
