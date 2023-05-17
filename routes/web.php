<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// TODO: Move this to `home` view, name the route
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('contributors', "StatsController@index")->name('contributors');

Route::get('installation', 'DocsController@installation');

Route::get('me', 'UserController@me')->name('me')->middleware('auth');
Route::get('me/edit', 'UserController@editMe')->name('me')->middleware('auth');
Route::post('me/edit', 'UserController@update_perks')->middleware('auth');
