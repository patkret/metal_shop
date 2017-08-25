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

Route::get('/', function () {
    return view('welcome');
});

//categories

Route::get('/categories', 'CategoriesController@index')->name('categories.index');
Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('/categories', 'CategoriesController@store')->name('categories.store');
Route::post('/categories/update/{category}', 'CategoriesController@update')->name('categories.update');
Route::get('/categories/roots', 'CategoriesController@roots')->name('categories.roots');
Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('/categories/{category}/children', 'CategoriesController@children')->name('categories.children');

Route::get('/categories/edit/{category}', 'CategoriesController@edit')->name('categories.edit');

Route::get('/categories/delete', 'CategoriesController@delete')->name('categories.delete');
Route::get('/categories/{parent}/append/{category}', 'CategoriesController@append')->name('categories.append');
Route::get('/categories/move/{preceding}/{category}/{following}', 'CategoriesController@move')->name('categories.move');
//Route::post('/categories', 'CategoriesController@store');
//Route::get('/categories/roots/', 'CategoriesController@showRoots');
//Route::get('/categories/{category}/children', 'CategoriesController@showChildren');
//Route::get('/categories/{category}/ancestors', 'CategoriesController@showAncestors');
//Route::get('/categories/edit/{category}', 'CategoriesController@edit')->name('categories.edit');
//Route::post('/categories/update/{category}', 'CategoriesController@update')->name('categories.update');
//Route::post('/categories/delete/{category}', 'CategoriesController@destroy')->name('categories.destroy');

// products
Route::get('/products/toggle/{product}', 'ProductsController@toggle')->name('products.toggle');
Route::get('/products/edit/{product}', 'ProductsController@edit')->name('products.edit');
Route::post('/products/update/{product}', 'ProductsController@update')->name('products.update');


Route::get('/products/by-category/{id}', 'ProductsController@showByCategory')->name('products.showByCategory');
Route::get('/products/by-phrase/{phrase}/{assigned}/{available}', 'ProductsController@showByPhrase')->name('products.showByPhrase');

Route::get('/products/assign', 'ProductsController@assign')->name('products.assign');
Route::post('/products/assign', 'ProductsController@assignProduct')->name('products.assignProduct');
Route::post('/products/unassign', 'ProductsController@unassignProduct')->name('products.unassignProduct');
Route::get('/products/show-products/{assigned}/{available}/{category?}/{query?}', 'ProductsController@showProducts')->name('products.showProducts');

Route::get('/products/prices', 'ProductsController@prices')->name('products.prices');
Route::get('/products/{product}/price', 'ProductsController@getPrice')->name('products.getPrice');

Route::get('/products/description', 'ProductsController@description')->name('products.description');


Route::get('/admin', function () {
    return view('admin/admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
