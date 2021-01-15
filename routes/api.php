<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Auth')->group(function(){
    Route::post('register','RegisterController');
    Route::post('verification','VerificationController');
    Route::post('regenerate-otp','RegenerateOtpController');
    Route::post('update-password','UpdatePasswordController');
    Route::post('login','LoginController');
    Route::post('logout','LogoutController');
});

Route::namespace('Profile')->middleware('auth:api')->group(function(){
    Route::get('profile/get-profile','ProfileController@index');
    Route::post('profile/update-profile','ProfileController@update');
    // Route::delete('delete-article/{article}','ArticleController@destroy');
});


Route::namespace('Article')->middleware('auth:api')->group(function(){
    Route::post('create-new-article','ArticleController@store');
    Route::patch('update-article/{article}','ArticleController@update');
    Route::delete('delete-article/{article}','ArticleController@destroy');
});

Route::get('user','UserController');

Route::get('articles/{article}','Article\ArticleController@show');
Route::get('articles','Article\ArticleController@index');
