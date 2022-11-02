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
        return redirect("/api/v1/oauth/discord/redirect?{$params}");
    });

    Route::get('logout', function (Request $request) {
        $params = http_build_query($request->input());
        return redirect("/api/v1/oauth/discord/logout?{$params}");
    });

    Route::get('oauth/discord/redirect', 'OAuthController@discordRedirect');
    Route::get('oauth/discord/callback', 'OAuthController@discordCallback');
    Route::get('oauth/discord/logout', 'OAuthController@discordLogout');

    Route::get('user/{id}', 'UserController@profile');

    Route::get('stats/contributors', 'StatsController@contributors');
});


// TODO: Figure out if every API route needs the auth middleware and start
// implementing it
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
