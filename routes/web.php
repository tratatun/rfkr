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
Route::get('/house', 'MainController@house')->name('house');
Route::get('/news', 'MainController@news')->name('news');
Route::get('/p/{page}-{pageTitle}', 'MainController@showPage')->name('page');
Route::get('/n/{news}-{newsTitle}', 'MainController@showNews')->name('newsOne');


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
Route::post('/admin/pages/{page}/change-status', 'Admin\PagesController@changeStatus')->name('admin.pages.change-status');
Route::delete('/admin/pages/{page}', 'Admin\PagesController@delete')->name('admin.pages.delete');

Route::get('/admin/news', 'Admin\NewsController@index')->name('admin.news');
Route::get('/admin/news/create', 'Admin\NewsController@create')->name('admin.news.create');
Route::post('/admin/news', 'Admin\NewsController@store')->name('admin.news.store');
Route::get('/admin/news/{news}/edit', 'Admin\NewsController@edit')->name('admin.news.edit');
Route::post('/admin/news/{news}', 'Admin\NewsController@update')->name('admin.news.update');
Route::post('/admin/news/{news}/change-status', 'Admin\NewsController@changeStatus')->name('admin.news.change-status');
Route::delete('/admin/news/{news}', 'Admin\NewsController@delete')->name('admin.news.delete');

Route::get('/admin/gov-resources', 'Admin\GovResourcesController@index')->name('admin.gov-resources');
Route::get('/admin/gov-resources/create', 'Admin\GovResourcesController@create')->name('admin.gov-resources.create');
Route::post('/admin/gov-resources', 'Admin\GovResourcesController@store')->name('admin.gov-resources.store');
Route::get('/admin/gov-resources/{gov_resource}/edit', 'Admin\GovResourcesController@edit')
    ->name('admin.gov-resources.edit');
Route::post('/admin/gov-resources/{gov_resource}', 'Admin\GovResourcesController@update')
    ->name('admin.gov-resources.update');
Route::post('/admin/gov-resources/{gov_resource}/change-status', 'Admin\GovResourcesController@changeStatus')->name('admin.gov-resources.change-status');
Route::delete('/admin/gov-resources/{gov_resource}', 'Admin\GovResourcesController@delete')->name('admin.gov-resources.delete');

Route::get('/admin/covers', 'Admin\CoversController@index')->name('admin.covers');
Route::get('/admin/covers/create', 'Admin\CoversController@create')->name('admin.covers.create');
Route::post('/admin/covers', 'Admin\CoversController@store')->name('admin.covers.store');
Route::get('/admin/covers/{cover}/edit', 'Admin\CoversController@edit')->name('admin.covers.edit');
Route::post('/admin/covers/{cover}', 'Admin\CoversController@update')->name('admin.covers.update');
Route::post('/admin/covers/{cover}/change-status', 'Admin\CoversController@changeStatus')->name('admin.covers.change-status');
Route::delete('/admin/covers/{cover}', 'Admin\CoversController@delete')->name('admin.covers.delete');

Route::get('/admin/sliders', 'Admin\SlidersController@index')->name('admin.sliders');
Route::get('/admin/sliders/create', 'Admin\SlidersController@create')->name('admin.sliders.create');
Route::post('/admin/sliders', 'Admin\SlidersController@store')->name('admin.sliders.store');
Route::get('/admin/sliders/{slider}/edit', 'Admin\SlidersController@edit')->name('admin.sliders.edit');
Route::post('/admin/sliders/{slider}', 'Admin\SlidersController@update')->name('admin.sliders.update');
Route::post('/admin/sliders/{slider}/change-status', 'Admin\SlidersController@changeStatus')->name('admin.sliders.change-status');
Route::delete('/admin/sliders/{slider}', 'Admin\SlidersController@delete')->name('admin.sliders.delete');

Route::get('/admin/seo-records', 'Admin\SeoRecordsController@index')->name('admin.seo-records');
Route::get('/admin/seo-records/create', 'Admin\SeoRecordsController@create')->name('admin.seo-records.create');
Route::post('/admin/seo-records', 'Admin\SeoRecordsController@store')->name('admin.seo-records.store');
Route::get('/admin/seo-records/{seo_record}/edit', 'Admin\SeoRecordsController@edit')->name('admin.seo-records.edit');
Route::post('/admin/seo-records/{seo_record}', 'Admin\SeoRecordsController@update')->name('admin.seo-records.update');
Route::post('/admin/seo-records/{seo_record}/change-status', 'Admin\SeoRecordsController@changeStatus')->name('admin.seo-records.change-status');
Route::delete('/admin/seo-records/{seo_record}', 'Admin\SeoRecordsController@delete')->name('admin.seo-records.delete');

Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');
Route::get('/admin/users/create', 'Admin\UsersController@create')->name('admin.users.create');
Route::get('/admin/users/{user}/edit', 'Admin\UsersController@edit')->name('admin.users.edit');
Route::post('/admin/users', 'Admin\RegisterController@register');
Route::post('/admin/users/{user}', 'Admin\UsersController@update')->name('admin.users.update');
Route::post('/admin/users/{user}/change-status', 'Admin\UsersController@changeStatus')->name('admin.users.change-status');
Route::post('/admin/users/{user}/login-as', 'Admin\UsersController@loginAs')->name('admin.users.login-as');

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
