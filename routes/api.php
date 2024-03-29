<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('login', function (Request $request) {
        $params = http_build_query($request->input());
        return redirect("/api/v1/oauth/discord/redirect?{$params}");
    })->name('login');

    Route::get('logout', function (Request $request) {
        $params = http_build_query($request->input());
        return redirect("/api/v1/oauth/discord/logout?{$params}");
    });

    Route::prefix('store')->group(function () {
        Route::get('list/{type}', 'StoreController@listItems');

        // HACK: Why the fuck does it fall through to the last route without this regex match?
        Route::get('{id}.asar', 'StoreController@getAsar')->where('id', '(.*)');

        Route::get('{id}', 'StoreController@getManifest');
    });

    Route::prefix('oauth')->group(function () {
        Route::prefix('discord')->group(function () {
            Route::redirect('/', '/api/v1/oauth/discord/redirect');
            Route::get('redirect', 'OAuthController@discordRedirect');
            Route::get('callback', 'OAuthController@discordCallback');
            Route::get('logout', 'OAuthController@discordLogout');
        });

        Route::middleware('auth')->prefix('patreon')->group(function () {
            Route::redirect('/', '/api/v1/oauth/patreon/redirect');
            Route::get('redirect', 'OAuthController@patreonRedirect');
            Route::get('callback', 'OAuthController@patreonCallback');
            Route::get('unlink', 'OAuthController@patreonUnlink');
        });
    });

    // Not a controller route because there's not really a controller that fits functionality like this.
    Route::get('react-devtools', 'StoreController@getRDT');

    Route::get('user/{id}', 'UserController@profile');

    Route::get('stats/contributors', 'StatsController@contributors');
});


// TODO: Figure out if every API route needs the auth middleware and start
// implementing it
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
