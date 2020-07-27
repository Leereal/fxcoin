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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth::routes();

Route::post('/login','Auth\AuthController@login')->name('api.login');

Route::post('/register','Auth\AuthController@register')->name('api.register');

Route::get('/users', 'UsersController@index');

Route::get('/users/{id}', 'UsersController@show');

Route::apiResource('/role','RoleController');

Route::apiResource('/package','PackagesController');

Route::apiResource('/payment-method','PaymentMethodController');

Route::apiResource('/payment-detail','PaymentDetailController');

Route::apiResource('/currency','CurrencyController');

//Route::apiResource('/referral','ReferralController');

Route::apiResource('/referral-bonus','ReferralBonusController');

Route::apiResource('/withdrawal','WithdrawalController');

Route::apiResource('/market-place','MarketPlaceController');

Route::apiResource('/pending-payment','PendingPaymentController');

Route::apiResource('/notification','NotificationController');

Route::apiResource('/bonus','BonusController');

Route::apiResource('/investment','InvestmentController');
