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

Route::get('/admin/pages', 'Admin\PagesController@pages');
Route::get('/admin/pages/add', 'Admin\PagesController@addPage');

Route::get('/admin/team', 'Admin\UsersController@users')->name('register-admin');
Route::post('/admin/team', 'Admin\RegisterController@register');


Route::get('/admin/treatments', 'Admin\TreatmentsController@treatments');
Route::get('/admin/treatments/answer', 'Admin\TreatmentsController@answerTreatment');
Route::get('/admin/treatments/review', 'Admin\TreatmentsController@reviewTreatment');


Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('login-admin');
Route::post('/admin/login', 'Admin\LoginController@login')->name('login-admin');

Route::get('/admin/logout', 'Admin\LoginController@logout')->name('logout-admin');
