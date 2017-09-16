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
Route::get('/admin', 'AdminController@index');
Route::get('/admin/pages', 'AdminController@pages');
Route::get('/admin/pages/add', 'AdminController@addPage');
Route::get('/admin/team', 'AdminController@team');
Route::get('/admin/treatments', 'AdminController@treatments');
Route::get('/admin/treatments/answer', 'AdminController@answerTreatment');
Route::get('/admin/treatments/review', 'AdminController@reviewTreatment');
Route::get('/admin/login', 'AdminController@login');
Route::get('/admin/logout', 'AdminController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
