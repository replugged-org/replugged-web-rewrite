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
    Route::redirect('/', '/store/plugins')->name('store');

    Route::get('/{type}', 'StoreController@showListing')->whereIn('type', ['plugins', 'themes']);
});

Route::get('contributors', "StatsController@index")->name('contributors');

Route::view('download', 'download')->name('download');

Route::get('me', 'UserController@me')->name('me')->middleware('auth');
Route::get('me/edit', 'UserController@editMe')->name('me')->middleware('auth');
Route::post('me/edit', 'UserController@update_perks')->middleware('auth');

Route::middleware('auth')->prefix('backoffice')->name('backoffice.')->group(function () {
    Route::redirect('/', '/backoffice/users');
    Route::get('users', 'BackofficeController@showUsers')->name('users');
    Route::get('users/{id}', 'BackofficeController@showEditUsers')->name('users.edit');
    Route::post('users/{id}', 'BackofficeController@editUser')->name('users.editUser');
});
