<?php
# @Author: Codeals
# @Date:   19-10-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals

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

use App\Events\ChatConversation;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Auth::routes(['register' => false]);

// PayPal
Route::get('payment', array(
	'as' => 'payment',
	'uses' => 'PaypalController@postPayment',
));

// Después de realizar el pago Paypal redirecciona a esta ruta
// Route::get('payment/status', array(
// 	'as' => 'payment.status',
// 	'uses' => 'PaypalController@getPaymentStatus',
// ));

// Route::get('offers', 'OfferController@index')->name('offers');

// usuarios registrados
Route::group(['middleware' => 'auth'], function () {

});

// usuarios admin
Route::group(['middleware' => 'admin'], function () {

  Route::get('users/change', 'UserController@changePassword')->name('users.change');

  Route::get('/', function () {
      // return view('welcome');
      return view('main');
  })->name('/');

  Route::get('/home', 'HomeController@index')->name('home');

  Route::resource('offers', 'OfferController');
  Route::resource('users', 'UserController');

  Route::post('users/store-password', 'UserController@storePassword')->name('users.store-password');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

  Route::get('home/dashboardChart/{year}', 'HomeController@dashboardChart')->name('home.dashboardChart');

  Route::get('reports/users', 'ReportController@userRechange')->name('reports.users');

  Route::get('settings/edit', 'SettingController@edit')->name('settings.edit');
  Route::put('settings/update/{id}', 'SettingController@update')->name('settings.update');


});
