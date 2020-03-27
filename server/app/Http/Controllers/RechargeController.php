<?php
# @Author: Codeals
# @Date:   22-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2019-11-26T18:07:03+01:00
# @Copyright: Codeals




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Recharge;
use App\Contact;
use App\ContactRecharge;
use App\User;

class RechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /******************************+
    *             API               *
    ********************************/

    //  Recharge list
    public function getRechargeList(Request $request)
    {
        return response(['data' => ContactRecharge::join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                    ->where('recharges.user_id', $request->user()->id)
                    ->where('recharges.is_deleted', 0)
                    ->get()], 200);

    }

    //  Recharge cell
    public function rechargeCell(Request $request)
    {
        $data = $request->all();

        $contact = Contact::where('user_id', $request->user()->id)
                 ->where('phone', $request->input('phone'))
                 ->first();

        if($contact) {
            $data['is_deleted'] = 0;
            $data['name'] = $request->input('name');
            $contact->update($data);
        } else {

          $data['phone'] = $request->input('phone');
          $data['name'] = $request->input('name');
          $data['is_deleted'] = 0;
          $data['user_id'] = $request->user()->id;

          $contact = Contact::create($data);
        }

        $contacts = array();
        array_push($contacts ,$contact->toArray());

        $response = $this->rechargeContact($contacts, $request->input('offer_id'), $request->user()->id, 'Cell');
        return response(['data' => $response], 201);
    }

    //  Recharge nauta
    public function rechargeNauta(Request $request)
    {
        //  aqui se formo la cosa, redsys y recojo y dingconnect
        $data = $request->all();

        $contact = Contact::where('user_id', $request->user()->id)
                 ->where('email', $request->input('email'))
                 ->first();

        if($contact) {
            $data['is_deleted'] = 0;
            $data['name'] = $request->input('name');
            $contact->update($data);
        } else {

            $data['email'] = $request->input('email');
            $data['name'] = $request->input('name');
            $data['is_deleted'] = 0;
            $data['user_id'] = $request->user()->id;

            $contact = Contact::create($data);
        }

        $contacts = array();
        array_push($contacts ,$contact->toArray());

        $response = $this->rechargeContact($contacts, $request->input('offer_id'), $request->user()->id, 'Nauta');

        return response(['data' => $response], 201);
    }

    public function multiRechargeCell(Request $request)
    {
        $contacts = $request->input('contacts');
        $offer_id = $request->input('offer');

        $response = $this->rechargeContact($contacts, $offer_id, $request->user()->id, 'Cell');

        return response(['data' => $response], 201);
    }

    public function multiRechargeNauta(Request $request)
    {
        $contacts = $request->input('contacts');
        $offer_id = $request->input('offer');

        $response = $this->rechargeContact($contacts, $offer_id, $request->user()->id, 'Nauta');

        return response(['data' => $response], 201);
    }

    public function rechargeContact($contacts, $offer_id, $user_id, $type)
    {
        // take offer
        $offer = Offer::findOrFail($offer_id);

        // create recharge
        $dataRecharge['type'] = $type;
        $dataRecharge['offer_id'] = $offer->id;
        $dataRecharge['user_id'] = $user_id;
        $dataRecharge['date_recharge'] = date("Y-m-d");
        $dataRecharge['price_pay'] = $offer->price_pay;
        $dataRecharge['recharge_amount'] = $offer->recharge_amount;
        $dataRecharge['status'] = "Waiting";
        $dataRecharge['is_deleted'] = 0;
        $recharge = Recharge::create($dataRecharge);

        $response["amount"] = 0;
        $response["count"] = 0;
        foreach ($contacts as $key => $contact) {

            $contactRecharge = new ContactRecharge();
            $contactRecharge->recharge_id = $recharge->id;
            $contactRecharge->contact_id = $contact['id'];
            $contactRecharge->user_id = $user_id;
            $type == 'Cell'? $contactRecharge->phone = $contact['phone'] : $contactRecharge->email = $contact['email'];
            $contactRecharge->message = '';
            $contactRecharge->is_deleted = 0;
            $contactRecharge->save();

            $response["amount"] += $offer->price_pay;
            $response["count"]++;
        }

        // pay and ding type of pay
        $response["type"] = $type;
        $response["recharge_id"] = $recharge->id;

        return $response;
    }

    public function startScheduled()
    {
        $today = Date('Y-m-d');
        $offers = Offer::where('date_ini', '=', $today)
                    ->where('is_deleted', '=', 0)
                    ->get();

        foreach ($offers as $offer) {

            $rechargeScheduleds = Recharge::where('offer_id', '=', $offer->id)
                                    ->where('status', '=', 'Scheduled')
                                    ->get();

            if (!$rechargeScheduleds->isEmpty()) {
              $this->_updateScheduled($rechargeScheduleds);
            }
        }
    }

    public function _updateScheduled($rechargeScheduleds)
    {
        foreach ($rechargeScheduleds as $recharge) {

            $contactRecharges = ContactRecharge::where('recharge_id', $recharge->id)->get();

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

            $recharge->status = "Accepted";
            $recharge->save();
        }
    }

    // Send a transfer to an account
  	function dingSendTransfer($telefono, $cantidad, $idFef, $SkuCode)
  	{
  			$url = "https://api.dingconnect.com/api/V1/SendTransfer";
  			$header = array(
  					"Content-Type: application/json",
  					"api_key: ".env('API_DING', '55NhaAwAtfu6VeuEGjiSZU') // secret api ding
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
