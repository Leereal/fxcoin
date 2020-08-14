<?php

use Illuminate\Support\Facades\Route;


//Auth::routes();

// Route::get('/', function () {
//      return "Hello world";
// });
 //Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

//Route::get('/{any}', 'HomeController@index')->where('any','.*'); if anything use this one 

Route::get('/{any}', 'Auth\AuthController@login')->where('any', '^(?!api).*$');