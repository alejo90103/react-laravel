<?php
# @Author: Codeals
# @Date:   26-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 03-01-2020
# @Copyright: Codeals

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Offer;
use App\Payment as PaymentMethod;
use App\Recharge;
use App\ContactRecharge;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Redirect;

class PaypalController extends BaseController
{
	private $_api_context;

	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);

		// dd($paypal_conf['settings']);
	}

	public function postPayment(Request $request)
	{

			$recharge = Recharge::where('user_id', $request->user()->id)
							 ->where('id', $request->input('offer_id'))
							 ->first();

			$offer = Offer::where('id', $recharge->offer_id)->first();

			$contactRecharges = ContactRecharge::where('recharge_id', $recharge->id)->get();

			$subtotal = $offer->price_pay * count($contactRecharges);

			$paymentMethod = PaymentMethod::create([
					'recharge_id' => $recharge->id,
					'user_id' => $request->user()->id,
					'token' => uniqid(),
					'method' => "Paypal",
					'amount' => $subtotal,
					'is_payment' => 0,
			]);

			$payer = new Payer();
			$payer->setPaymentMethod('paypal');

			$items = array();
			// $subtotal = 0;
			$currency = 'EUR';

			$item = new Item();
			$item->setName("Serv Recarga")
			->setCurrency($currency)
			->setDescription(" Servicio de Recargas Cubacel")
			->setQuantity(1)
			->setPrice($subtotal);
			//----------

			$items[] = $item;
			// $subtotal = 1 * 20;

			// items paypal
			// $item = new Item();
			// $items[] = array('Recarga' => 'Serv recarga');

			// list items paypal
			$item_list = new ItemList();
			$item_list->setItems($items);

			// details paypal
			$details = new Details();
			$details->setSubtotal($subtotal)
			->setShipping(0);

			// bimp + iva
			$total = $subtotal;

			// amount paypal
			$amount = new Amount();
			$amount->setCurrency($currency)
				->setTotal($total)
				->setDetails($details);

			$transaction = new Transaction();
			$transaction->setAmount($amount)
				->setItemList($item_list)
				->setDescription('Servicios de recargas. Cuba Recargame');

			$redirect_urls = new RedirectUrls();
			$redirect_urls->setReturnUrl(\URL::route('payment.status', $paymentMethod->token))
				->setCancelUrl(\URL::route('payment.status', $paymentMethod->token));

			$payment = new Payment();
			$payment->setIntent('Sale')
				->setPayer($payer)
				->setRedirectUrls($redirect_urls)
				->setTransactions(array($transaction));

			try {
				$payment->create($this->_api_context);
			} catch (\PayPal\Exception\PPConnectionException $ex) {
				if (\Config::get('app.debug')) {
					echo "Exception: " . $ex->getMessage() . PHP_EOL;
					$err_data = json_decode($ex->getData(), true);
					exit;
				} else {
					die('Ups! Algo salió mal');
				}
			}

			foreach($payment->getLinks() as $link) {
				if($link->getRel() == 'approval_url') {
					$redirect_url = $link->getHref();
					break;
				}
			}

			// add payment ID to session
			// \Session::put('paypal_payment_id', $payment->getId());
			$paymentMethod->paypal_payment_id = $payment->getId();
			$paymentMethod->save();

			if(isset($redirect_url)) {
				// redirect to paypal
				// return \Redirect::away($redirect_url);

				return response(['data' => $redirect_url], 200);
			}

			$recharge->status = "Cancel";
			$recharge->save();

			return Redirect::to(env('APP_CLIENT', 'https://turecarguita.com').'/dashboard/failed');
			// return Redirect::to("http://localhost:8080/dashboard/failed");

			// return \Redirect::route('/')
			// 	->with('error', 'Ups! Error desconocido.');
	}

	public function getPaymentStatus($tokenPay, Request $request)
	{
		// Get the payment ID before session clear
		// $payment_id = \Session::get('paypal_payment_id');
		$paymentBack = PaymentMethod::where('token', '=', $tokenPay)->first();
		$recharge = Recharge::where('id', $paymentBack->recharge_id)->first();

		// return response(['data' => $paymentBack], 200);

		// clear the session payment ID
		// \Session::forget('paypal_payment_id');

		$payerId = $request->PayerID;
		$token = $request->token;

		//if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
		if (empty($payerId) || empty($token)) {

				$recharge->status = "Cancel";
				$recharge->save();

				return Redirect::to(env('APP_CLIENT', 'https://turecarguita.com').'/dashboard/failed');
				// return Redirect::to("http://localhost:8080/dashboard/failed");

			// return \Redirect::route('home')
			// 	->with('message', 'Hubo un problema al intentar pagar con Paypal');
		}

		$payment = Payment::get($paymentBack->paypal_payment_id, $this->_api_context);

		// PaymentExecution object includes information necessary
		// to execute a PayPal account payment.
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);

		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);

		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

		if ($result->getState() == 'approved') { // payment made
			// Registrar el pedido --- ok
			// Registrar el Detalle del pedido  --- ok
			// Eliminar carrito
			// Enviar correo a user
			// Enviar correo a admin
			// Redireccionar

			$offer = Offer::where('id', $recharge->offer_id)->first();
			$contactRecharges = ContactRecharge::where('recharge_id', $paymentBack->recharge_id)->get();

			$now = Date('Y-m-d');

			if($now < $offer->date_ini && $offer->ads == 1) {
					$recharge->status = 'Scheduled';
					$recharge->save();

					// programacion success
					return Redirect::to(env('APP_CLIENT', 'https://turecarguita.com').'/dashboard/success');
					// return Redirect::to("http://localhost:8080/dashboard/success");
			}

			$user = User::find($recharge->user_id);

			// call ding
			foreach ($contactRecharges as $contactRecharge) {

					$user->accumulated += $recharge->price_pay * 0.01;
					$user->save();

					if ($recharge->type == "Cell") {
							$status = $this->dingSendTransfer($contactRecharge->phone, $recharge->recharge_amount, $contactRecharge->id, "CU_CU_TopUp");
					} else {
							$status = $this->dingSendTransfer($contactRecharge->email, $recharge->recharge_amount, $contactRecharge->id, "CU_NU_TopUp");
					}
			}

			if ($status == true) {
				//
				$recharge->status = "Accepted";
				$recharge->save();
				$paymentBack->is_payment = 1;
				$paymentBack->save();
				// $urlBack = Setting::first()->server_client;
				// return Redirect::to($urlBack."dashboard/success");
				return Redirect::to(env('APP_CLIENT', 'https://turecarguita.com').'/dashboard/success');
				// return Redirect::to("http://localhost:8080/dashboard/success");
			} else {
				//
				$recharge->status = "Denied";
				$recharge->save();
				// $urlBack = Setting::first()->server_client;
				// return Redirect::to($urlBack."dashboard/failedDing");
				return Redirect::to(env('APP_CLIENT', 'https://turecarguita.com').'/dashboard/failedDing');
				// return Redirect::to("http://localhost:8080/dashboard/failedDing");
			}

			// $this->saveOrder(\Session::get('cart'));

			// \Session::forget('cart');


			// return \Redirect::route('home')
			// 	->with('message', 'Compra realizada de forma correcta');
		}

		return Redirect::to(env('APP_CLIENT', 'https://turecarguita.com').'/dashboard/failed');
		// return Redirect::to("http://localhost:8080/dashboard/failed");
		// return \Redirect::route('home')
		// 	->with('message', 'La compra fue cancelada');
	}

	// Send a transfer to an account
	function dingSendTransfer($telefono, $cantidad, $idFef, $SkuCode)
	{
			$url = "https://api.dingconnect.com/api/V1/SendTransfer";
			$header = array(
					"Content-Type: application/json",
					"api_key: ".env('API_DING', '0K4ixoSWSOy6Vd9I1IEWgf') // secret api ding
			);

			// para hacer transferencia requerido
			// SkuCode						//ej: CU_CU_TopUp (CUBA)
			// SendValue					// send value dinero a porner
			// ValidateOnly				// true
			// DistributorRef			// esto es un numero de referencia deberia ser autoincrementar
			// AccountNumber			// cuenta telefonica a la cual se le hace la transferencia

			$dataTransf = array('SkuCode' => $SkuCode, 'SendValue' => $cantidad, 'ValidateOnly' => false, 'DistributorRef' => $idFef, 'AccountNumber' => $telefono);

			$somoPost = json_encode($dataTransf);
			// echo $url;
			$api = curl_init();
			curl_setopt($api,CURLOPT_URL,$url);
			curl_setopt($api,CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($api,CURLOPT_HTTPHEADER,$header);
			curl_setopt($api, CURLOPT_POSTFIELDS, $somoPost);
			curl_setopt($api,CURLOPT_RETURNTRANSFER, true);
			$apiResult = curl_exec($api);
			$apiCurlError = curl_error($api);
			$status = curl_getinfo($api, CURLINFO_HTTP_CODE);
			if( ! $apiResult)
			{
					trigger_error(curl_error($api));
			}
			curl_close($api);

			// Convert JSON string to Array
			$someArray = json_decode($apiResult, true);
			//

			if ($someArray["ResultCode"] == 1 || $someArray["ResultCode"] == 2) {
				return true;

			} else {
				return false;
			}
	}

}
