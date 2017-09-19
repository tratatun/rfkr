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
Route::get('/', 'MainController@index')->name('home');

Route::get('/rules', 'TreatmentsController@rules')->name('treatments.rules');
Route::get('/treatment', 'TreatmentsController@create')->name('treatments.create');
Route::post('/treatment', 'TreatmentsController@store')->name('treatments.store');

Route::get('/search', 'MainController@search')->name('search');

// Admin pages (private pages)
Route::get('/admin', 'Admin\DefaultController@index')->name('admin.main');

Route::get('/admin/pages', 'Admin\PagesController@index')->name('admin.pages');
Route::get('/admin/pages/create', 'Admin\PagesController@create')->name('admin.pages.create');
Route::post('/admin/pages', 'Admin\PagesController@store')->name('admin.pages.store');
Route::post('/admin/pages/{page}/pages', 'Admin\PagesController@storeSubPage')->name('admin.pages.store.subpage');
Route::get('/admin/pages/{page}/edit', 'Admin\PagesController@edit')->name('admin.pages.edit');
Route::post('/admin/pages/{page}', 'Admin\PagesController@update')->name('admin.pages.update');

Route::get('/admin/news', 'Admin\NewsController@index')->name('admin.news');
Route::get('/admin/news/create', 'Admin\NewsController@create')->name('admin.news.create');
Route::post('/admin/news', 'Admin\NewsController@store')->name('admin.news.store');
Route::get('/admin/news/{page}/edit', 'Admin\NewsController@edit')->name('admin.news.edit');
Route::post('/admin/news/{page}', 'Admin\NewsController@update')->name('admin.news.update');

Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');
Route::get('/admin/users/create', 'Admin\UsersController@create')->name('admin.users.create');
Route::get('/admin/users/{user}/edit', 'Admin\UsersController@edit')->name('admin.users.edit');
Route::post('/admin/users', 'Admin\RegisterController@register');
Route::post('/admin/users/{user}', 'Admin\UsersController@update')->name('admin.users.update');

Route::get('/admin/treatments', 'Admin\TreatmentsController@index')->name('admin.treatments');
Route::post('/admin/treatments/{treatment}/spam', 'Admin\TreatmentsController@spam')
    ->name('admin.treatments.spam');

Route::get('/admin/treatments/{treatment}/answer', 'Admin\TreatmentAnswersController@create')
    ->name('admin.treatment-answers.create');

Route::post('/admin/treatments/{treatment}/answers', 'Admin\TreatmentAnswersController@store')
    ->name('admin.treatment-answers.store');

Route::get('/admin/treatments/{treatment}/review', 'Admin\TreatmentAnswersController@index')
    ->name('admin.treatment-answers.index');


Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\LoginController@login');

Route::get('/admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
