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

// TODO: Move this to `home` view, name the route
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('contributors', "StatsController@index")->name('contributors');

Route::get('contributors', "StatsController@index");
