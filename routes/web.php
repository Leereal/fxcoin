<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
//  });

Route::get('/{any}', 'HomeController@index')->where('any','.*');
