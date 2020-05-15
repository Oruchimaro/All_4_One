<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Blog routes
 */
Route::name('blog.')->prefix('blog')->group(function () {
	Route::get('/', 'Blog\BlogController@index')->name('index');
	Route::get('/mine', 'Blog\BlogController@mine')->name('mine');
	Route::get('/create', 'Blog\PostController@create')->name('create');
	Route::post('/create/post', 'Blog\PostController@store')->name('post.store');
	Route::get('/view/{post:slug}', 'Blog\PostController@show')->name('post.show');
	Route::get('/update/{post:slug}', 'Blog\PostController@edit')->name('post.edit');
	Route::put('/update/{post:slug}', 'Blog\PostController@update')->name('post.update');
	Route::delete('/delete/{post:slug}', 'Blog\PostController@destroy')->name('post.destroy');
});
