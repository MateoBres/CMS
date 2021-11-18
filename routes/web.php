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

Route::get('/sitemap.xml', 'SitemapController@index');


// Route::get('/home', function () {
//     return response()->view('errors.404', [], 404);
// });

Route::get('/{any}', function () {
    return view('welcome', [
        'stripePK' => getenv('STRIPE_KEY')
    ]);
})->where('any', '.*');


/* Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'role:publisher'], 'prefix' => 'publisher'], function () {
    Route::get('/{user}', 'UserController@show');
});

Route::group(['middleware' => ['auth', 'role:std_user'], 'prefix' => 'user'], function () {
    Route::get('/{user}', 'UserController@show');
});

Route::group(['middleware' => ['auth', 'role:administrator'], 'prefix' => 'administrator'], function () {
    Route::get('/{user}', 'UserController@show');
}); */


/* Route::get('/{any}', 'welcome')->where('any', '.*'); */
