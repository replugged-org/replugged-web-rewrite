<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('login', function (Request $request) {
        $params = http_build_query($request->input());
        return redirect("/api/v1/oauth/discord?{$params}");
    });

    Route::get('oauth/discord', 'OAuthController@discord');
});


// TODO: Figure out if every API route needs the auth middleware and start
// implementing it
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
