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

Route::group([
    'middleware' => 'check_role'
], function () {
    Route::get('/categories', 'CategoriesController@index')->name('categories.index');
    Route::get('/categories/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/categories', 'CategoriesController@store')->name('categories.store');
    Route::post('/categories/update/{category}', 'CategoriesController@update')->name('categories.update');
    Route::get('/categories/roots', 'CategoriesController@roots')->name('categories.roots');
    Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');
    Route::get('/categories/{category}/children', 'CategoriesController@children')->name('categories.children');

    Route::get('/categories/edit/{category}', 'CategoriesController@edit')->name('categories.edit');

    Route::delete('/categories/delete/{category}', 'CategoriesController@delete')->name('categories.delete');
    Route::get('/categories/{parent}/append/{category}', 'CategoriesController@append')->name('categories.append');
    Route::get('/categories/move/{preceding}/{category}/{following}', 'CategoriesController@move')->name('categories.move');

// products


    Route::get('/products', 'ProductsController@index')->name('products.index');
    Route::get('/products/create', 'ProductsController@create')->name('products.create');
    Route::post('/products', 'ProductsController@store')->name('products.store');
    Route::get('/products/toggle/{product}', 'ProductsController@toggle')->name('products.toggle');
    Route::get('/products/show/{product}', 'ProductsController@show')->name('products.show');
    Route::get('/products/edit/{product}', 'ProductsController@edit')->name('products.edit');
    Route::put('/products/update/{product}', 'ProductsController@update')->name('products.update');

//product categories
    Route::get('/productcategories', 'ProductCategoriesController@index')->name('productcategories.index');
    Route::post('/productcategories/find-products', 'ProductCategoriesController@findProducts')->name('productcategories.findProducts');
    Route::post('products/find-category', 'ProductCategoriesController@findCategory')->name('productcategories.findCategory');
    Route::get('/products/by-category/{id}', 'ProductCategoriesController@showByCategory')->name('products.showByCategory');


//    Route::post('/productcategories/showByPhrase/{assigned}/{available}', 'ProductCategoriesController@showByPhrase')->name('productcategories.showByPhrase');
//    Route::get('/product-categories/assign', 'ProductsController@assign')->name('products.assign');
//    /{assigned}/{available}
//    Route::post('/products/assign', 'ProductsController@assignProduct')->name('products.assignProduct');
//    Route::post('/products/unassign', 'ProductsController@unassignProduct')->name('products.unassignProduct');
//   Route::get('/products/show-products/{assigned}/{available}/{category?}/{query?}', 'ProductsController@showProducts')->name('products.showProducts');
//    Route::get('/products/price', 'ProductsController@price')->name('products.price');
//    Route::get('/products/{product}/price', 'ProductsController@getPrice')->name('products.getPrice');
//    Route::get('/products/description', 'ProductsController@description')->name('products.description');


// SETS

    Route::get('/sets', 'SetsController@index')->name('sets.index');
    Route::get('/sets/create', 'SetsController@create')->name('sets.create');
    Route::get('/sets/{set}/edit', 'SetsController@edit')->name('sets.edit');
    Route::get('/sets/{set}/delete', 'SetsController@destroy')->name('sets.destroy');
    Route::post('/sets/{set}/update', 'SetsController@update')->name('sets.update');
    Route::post('/sets/store', 'SetsController@store')->name('sets.store');


// GROUPS

    Route::get('/groups', 'GroupsController@index')->name('groups.index');
    Route::get('/groups/create', 'GroupsController@create')->name('groups.create');
    Route::post('/groups', 'GroupsController@store')->name('groups.store');
    Route::get('/groups/{groups}/edit', 'GroupsController@edit')->name('groups.edit');
    Route::put('/groups/{groups}', 'GroupsController@update')->name('groups.update');
    Route::delete('/groups/{groups}', 'GroupsController@destroy')->name('groups.destroy');


// USERS

    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/{users}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{users}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{users}', 'UsersController@destroy')->name('users.destroy');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/create', 'UsersController@store')->name('users.store');


    Route::get('/home', 'HomeController@index')->name('home');

//ROLES
    Route::get('/roles', 'RolesController@index')->name('roles.index');
    Route::get('/roles/create', 'RolesController@create')->name('roles.create');
    Route::post('/roles', 'RolesController@store')->name('roles.store');
    Route::get('/roles/{roles}/edit', 'RolesController@edit')->name('roles.edit');
    Route::put('/roles/{roles}', 'RolesController@update')->name('roles.update');
    Route::delete('/roles/{roles}', 'RolesController@destroy')->name('roles.destroy');

//STATUS

    Route::get('/status', 'StatusController@index')->name('status.index');
    Route::get('/status/create', 'StatusController@create')->name('status.create');
    Route::post('/status', 'StatusController@store')->name('status.store');
    Route::get('/status/{status}/edit', 'StatusController@edit')->name('status.edit');
    Route::put('/status/{status}', 'StatusController@update')->name('status.update');
    Route::delete('/status/{status}', 'StatusController@destroy')->name('status.destroy');

//ORDERS

    Route::get('/orders', 'OrdersController@index')->name('orders.index');
    Route::get('/orders/create', 'OrdersController@create')->name('orders.create');
    Route::get('/orders/{order}/edit', 'OrdersController@edit')->name('orders.edit');
    Route::post('/orders/find-users', 'OrdersController@findUsers')->name('orders.findUsers');
    Route::post('/orders/find-products/', 'OrdersController@findProducts')->name('orders.findProducts');
    Route::post('/orders', 'OrdersController@store')->name('orders.store');
    Route::put('/orders/{order}', 'OrdersController@update')->name('orders.update');
    Route::delete('/orders/{order}', 'OrdersController@destroy')->name('orders.destroy');
    Route::delete('/orders/delete-item/{order}', 'OrdersController@deleteItem')->name('orders.destroy');
});

Route::get('/main', function () {
    return view('main.index');
});


Auth::routes();
