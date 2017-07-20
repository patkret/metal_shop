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

use App\Category;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', 'CategoriesController@index')->name('categories.index');
Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories', 'CategoriesController@store');
Route::get('/categories/{category}/children', 'CategoriesController@showChildren');
Route::get('/categories/{category}/ancestors', 'CategoriesController@showAncestors');
Route::get('/categories/edit/{category}', 'CategoriesController@edit')->name('categories.edit');
Route::post('/categories/update/{category}', 'CategoriesController@update')->name('categories.update');
Route::post('/categories/delete/{category}', 'CategoriesController@destroy')->name('categories.destroy');

Route::get('/admin', function () {
    return view('admin/admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
