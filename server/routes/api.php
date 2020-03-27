<?php
# @Author: Codeals
# @Date:   20-10-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2019-11-27T01:26:20+01:00
# @Copyright: Codeals

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

Route::get('test', function () {
    return response([1,2,3], 200);
});

Route::post('forgot-password', 'UserController@forgotPassword');
Route::post('reset-password', 'UserController@resetPassword');
Route::post('user-register', 'UserController@registerPassword');
Route::post('user-active', 'UserController@activeUser');

Route::get('offer-list', 'OfferController@allOffer');

/*paymant return*/
Route::post('response-paypal', 'PaypalController@index');
Route::post('response-redsys/response/{token}', 'RedsysController@response');
Route::post('response-redsys/ok/{token}', 'RedsysController@responseOk');
Route::get('response-redsys/ko/{token}', 'RedsysController@responseKo');

// Después de realizar el pago Paypal redirecciona a esta ruta
Route::get('payment/status/{token}', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));

Route::middleware('auth:api')->get('/user', function (Request $request) {
	if ($request->user()->status == 1) {
		return $request->user();
	}

	return response(['data' => 'User is not activated :('], 404);
	//return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('change-password', 'UserController@changePasswordApi');

    /*recharge url*/
    Route::post('recharge-cell', 'RechargeController@rechargeCell');
    Route::post('recharge-nauta', 'RechargeController@rechargeNauta');
    Route::post('multi-recharge-cell', 'RechargeController@multiRechargeCell');
    Route::post('multi-recharge-nauta', 'RechargeController@multiRechargeNauta');
    Route::get('recharge-list', 'RechargeController@getRechargeList');

    /*contact url*/
    Route::get('contact-list', 'ContactController@getContactList');
    Route::post('contact-get', 'ContactController@getContactById');
    Route::post('contact-add', 'ContactController@saveAddContact');
    Route::put('contact-update', 'ContactController@saveUpdateContact');
    Route::post('contact-delete', 'ContactController@deleteContact');

    /*paymant url*/
    Route::post('pay-paypal', 'PaypalController@postPayment');
    Route::post('pay-redsys', 'RedsysController@index');

    // PayPal
    // Route::post('payment', array(
    // 	'as' => 'payment',
    // 	'uses' => 'PaypalController@postPayment',
    // ));

});
