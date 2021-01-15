<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// //Route::get('/route-1', 'TestController@route1')->middleware('admin');


// Route::get('/route-1',function(){
//     return 'masuk';
// })->middleware(['auth','verified.email']);

// Route::get('/route-2',function(){
//     return 'masuk';
// })->middleware(['auth','verified.email','admin']);


// // Route::middleware(['auth','verified.email'])->group(function(){
// //     Route::get('/route-1', 'TestController@route1');
// // });

// // Route::middleware(['auth','admin'])->group(function(){
// //     Route::get('/route-2', 'TestController@route2');
// // });


