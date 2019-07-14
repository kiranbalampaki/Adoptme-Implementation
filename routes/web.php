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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');
Route::get('/help', 'PagesController@help');


Route::get('/cart', 'PagesController@cart');

Route::resource('pets', 'PetController');
Route::resource('admin', 'AdminController');

Route::resource('categories', 'CategoryController');
Route::resource('products', 'ProductController');

Route::resource('stories', 'StoryController');
Route::resource('orders', 'OrderController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('admin', 'AdminController');

// Route::get('createblog', 'BlogController@create');
// Route::get('admin/createblog', 'BlogController@create');
Route::get('blogs/blogindex', 'AdminController@blogindex');
Route::get('admin/userindex', 'AdminController@userindex');
Route::get('/productindex', 'ProductController@productindex')->name('productindex');

Route::get('user/editprofile', 'AdminController@edit');
Route::get('user/update', 'AdminController@update');
// Route::get('admin/editblog', 'BlogController@update');
// Route::get('blogs/destroy', 'BlogController@destroy');


Route::get('user/petindex', 'UserController@petindex')->name('petindex');
Route::get('user/purchases', 'UserController@purchaseindex');

// Route::group(['middleware' => 'auth'], function() {
Route::resource('user', 'UserController');

Route::resource('messages', 'MessageController');

Route::resource('channels', 'ChannelController');
// Route::get('messages', 'MessageController@index');
// Route::get('messages/{message}', 'MessageController@show');
// Route::get('messages/{message}', 'MessageController@store');

Route::resource('blogs', 'BlogController');
Route::get('add-to-cart/{id}', 'ProductController@addToCart');
Route::patch('update-cart', 'ProductsController@update');
Route::delete('remove-from-cart', 'ProductsController@remove');
// });