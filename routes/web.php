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

Route::view('/', 'home')->name('home');

Route::prefix('store')->group(function () {
    // By default, go to plugin listing
    Route::redirect('/', '/store/plugins');

    Route::get('/{type}', 'StoreController@showListing')->whereIn('type', ['plugins', 'themes']);
});

Route::get('contributors', "StatsController@index")->name('contributors');

Route::get('installation', 'DocsController@installation');

Route::get('me', 'UserController@me')->name('me')->middleware('auth');
Route::get('me/edit', 'UserController@editMe')->name('me')->middleware('auth');
Route::post('me/edit', 'UserController@update_perks')->middleware('auth');
