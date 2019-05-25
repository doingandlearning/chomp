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

Route::Resource('/signup', 'SignupController');

Route::get('/select-session', 'SelectSessionController@index');
Route::post('/select-session', 'SelectSessionController@store');
Route::get('family/{id}', 'SelectSessionController@update');

Route::get('register/{id}', 'RegisterController@index');
Route::post('register', 'RegisterController@register');
