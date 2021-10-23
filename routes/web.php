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

Route::middleware(['basicAuth'])->group(function () {
    //All the routes are placed in here
   Route::get('movies', 'MoviesController@getAllMovies');
Route::get('movies/{id}', 'MoviesController@getMovieById');
Route::post('movies', 'MoviesController@addMovie');
Route::put('movies/{id}', 'MoviesController@updateMovie');
Route::delete('movies/{id}', 'MoviesController@deleteMovie');
});


