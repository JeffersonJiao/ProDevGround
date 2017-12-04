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

Route::get('/', 'PagesController@getIndex');

Route::get('/about','PagesController@getAboutPage');

Route::get('/contact','PagesController@getContactPage');
Route::resource('projects','ProjectsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::resource('teams','TeamsController');