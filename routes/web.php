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

Route::get('/p/{page}-{pageTitle}', 'MainController@showPage')->name('page');
Route::get('/n/{news}-{newsTitle}', 'MainController@showNews')->name('newsOne');

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
Route::get('/admin/news/{news}/edit', 'Admin\NewsController@edit')->name('admin.news.edit');
Route::post('/admin/news/{news}', 'Admin\NewsController@update')->name('admin.news.update');

Route::get('/admin/gov-resources', 'Admin\GovResourcesController@index')->name('admin.gov-resources');
Route::get('/admin/gov-resources/create', 'Admin\GovResourcesController@create')->name('admin.gov-resources.create');
Route::post('/admin/gov-resources', 'Admin\GovResourcesController@store')->name('admin.gov-resources.store');
Route::get('/admin/gov-resources/{gov_resource}/edit', 'Admin\GovResourcesController@edit')
    ->name('admin.gov-resources.edit');
Route::post('/admin/gov-resources/{gov_resource}', 'Admin\GovResourcesController@update')
    ->name('admin.gov-resources.update');

Route::get('/admin/covers', 'Admin\CoversController@index')->name('admin.covers');
Route::get('/admin/covers/create', 'Admin\CoversController@create')->name('admin.covers.create');
Route::post('/admin/covers', 'Admin\CoversController@store')->name('admin.covers.store');
Route::get('/admin/covers/{cover}/edit', 'Admin\CoversController@edit')->name('admin.covers.edit');
Route::post('/admin/covers/{cover}', 'Admin\CoversController@update')->name('admin.covers.update');

Route::get('/admin/sliders', 'Admin\SlidersController@index')->name('admin.sliders');
Route::get('/admin/sliders/create', 'Admin\SlidersController@create')->name('admin.sliders.create');
Route::post('/admin/sliders', 'Admin\SlidersController@store')->name('admin.sliders.store');
Route::get('/admin/sliders/{slider}/edit', 'Admin\SlidersController@edit')->name('admin.sliders.edit');
Route::post('/admin/sliders/{slider}', 'Admin\SlidersController@update')->name('admin.sliders.update');

Route::get('/admin/seo-records', 'Admin\SeoRecordsController@index')->name('admin.seo-records');
Route::get('/admin/seo-records/create', 'Admin\SeoRecordsController@create')->name('admin.seo-records.create');
Route::post('/admin/seo-records', 'Admin\SeoRecordsController@store')->name('admin.seo-records.store');
Route::get('/admin/seo-records/{seo_record}/edit', 'Admin\SeoRecordsController@edit')->name('admin.seo-records.edit');
Route::post('/admin/seo-records/{seo_record}', 'Admin\SeoRecordsController@update')->name('admin.seo-records.update');

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
