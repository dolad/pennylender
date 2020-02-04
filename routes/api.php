<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

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



// Route::prefix('api')->middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register','API\RegisterController@register');

Route::post('/login','API\RegisterController@login')->name('login');

// Route::post('/login','API\RegisterController@login')->name('login');


Route::middleware('auth:api')->prefix('v1')->group(function (){
    Route::resource('contact','API\ContactController');

    // Route::post('/contact','API\ContactController@store');
    // Route::put('/contact','API\ContactController@update');
    // Route::get('/contact','API\ContactController@index');
    // Route::delete('/contact','API\ContactController@destroy');
    // Route::get('/contact/{id}','API\ContactController@show');

});
