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
Route::get('/admin/pages', 'AdminController@pages');
Route::get('/admin/pages/add', 'AdminController@addPage');
Route::get('/admin/team', 'AdminController@team');
Route::get('/admin/login', 'AdminController@login');
