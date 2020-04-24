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

Route::get('/helloworld', function () {
    return 'Hello World';
});

Route::post('/helloworld2', function () {
    return 'Hello World';
});

Route::delete('/helloworld3', function () {
    return 'Hello World';
});

Route::get('/helloworld4', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/about', function () {
    return view('pages.about');
});
/* Inserting dynamic parameters into the url */
Route::get('/users/{id}', function ($id) {
    return 'This is user: '.$id;
});

Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'This is user: '.$name.' with an id of  '.$id;
});

/* Best practice would be to set the route to a controller which will navigate to a view*/
Route::get('/index', 'PagesController@index');
Route::get('/index02', 'PagesController@index2');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/products', 'PagesController@products');
Route::get('/contact', 'PagesController@contact');

Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
