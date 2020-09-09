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
Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('password/email', 'Auth\Api\ForgotPasswordController@forgot');
Route::post('password_reset', 'Auth\Api\ForgotPasswordController@reset')->name('password.reset');
Route::get('password/reset/{token}', 'Auth\Api\ForgotPasswordController@getReset');

Route::post('/validated', 'Auth\AuthController@validated')->name('api.validated');

Route::post('/login', 'Auth\AuthController@login')->name('api.login');

Route::post('/register', 'Auth\AuthController@register')->name('api.register');

Route::get('email/verify/{id}', 'Auth\Api\VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name

Route::get('email/resend', 'Auth\Api\VerificationController@resend')->name('verification.resend');

Route::get('/country', 'CountryController@index');

Route::apiResource('/currency', 'CurrencyController');

Route::middleware('auth:api')->group(function () {

    Route::post('/change-password', 'Auth\AuthController@change_password');

    Route::post('/logout', 'Auth\AuthController@logout')->name('api.logout');

    Route::get('/users', 'UsersController@index');

    Route::get('/users/{id}', 'UsersController@show');

    Route::apiResource('/role', 'RoleController');

    Route::apiResource('/package', 'PackagesController');

    Route::apiResource('/payment-method', 'PaymentMethodController');

    Route::apiResource('/payment-detail', 'PaymentDetailController');

    //Route::apiResource('/referral','ReferralController');

    Route::apiResource('/referral-bonus', 'ReferralBonusController');

    Route::apiResource('/withdrawal', 'WithdrawalController');

    Route::apiResource('/market-place', 'MarketPlaceController');

    Route::apiResource('/pending-payment', 'PendingPaymentController');

    Route::apiResource('/notification', 'NotificationController');

    Route::apiResource('/bonus', 'BonusController');

    Route::apiResource('/investment', 'InvestmentController');

    //Routes for payment details
    Route::get('/investments', 'InvestmentController@investments');

    //Routes for offers
    Route::get('/offers', 'PendingPaymentController@offers');
    Route::post('/make-payment', 'PendingPaymentController@make_payment');
    Route::post('/approve-payment', 'PendingPaymentController@approve_payment');


    //Routes for pending payments
    Route::get('/pending-payments', 'MarketPlaceController@pending_payments');
    Route::get('/user-pending-payments', 'PendingPaymentController@user_pending_payments');

    //Routes for payment details
    Route::get('/user-payment-details', 'PaymentDetailController@user_payment_details');

    Route::post('/update-profile', 'UsersController@update');
    Route::get('/referrals', 'UsersController@referrals');


    //Routes for settings
    Route::post('/open-market-place', 'SettingsController@open_market_place');
    Route::post('/close-market-place', 'SettingsController@close_market_place');
    Route::get('/market-open', 'SettingsController@market_open');

    //Referral Bonuses Routes
    Route::get('/user-referral-bonus', 'ReferralBonusController@user_referral_bonus');

    //Dashboard Routes
    Route::get('/dashboard', 'DashboardController@dashboard');

    //Routes for packages
    Route::get('/deposit-packages', 'PackagesController@deposit_packages');
    Route::get('/peer-packages', 'PackagesController@peer_packages');


    //Routes for payment methods
    Route::get('/user-payment-methods', 'PaymentMethodController@user_payment_methods');

    //Routes forbonus
    Route::get('/user-bonus', 'BonusController@user_bonus');
});
