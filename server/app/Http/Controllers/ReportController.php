<?php
# @Author: Codeals
# @Date:   05-12-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 05-12-2019
# @Copyright: Codeals

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Contact;
use App\Recharge;
use App\Offer;
use App\ContactRecharge;

class ReportController extends Controller
{
    public function userRechange()
    {
        $userRechanges = Recharge::join('offers', 'offers.id', '=', 'recharges.offer_id')
                          ->join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                          // ->join('contacts', 'contacts.id', '=', 'contact_recharges.contact_id')
                          ->where('recharges.user_id', '=', Auth::id())
                          ->where('recharges.is_deleted', '=', 0)
                          ->select(array('recharges.*', 'offers.*', 'contact_recharges.phone', 'contact_recharges.email'))
                          ->get();

        return view('reports.user', compact('userRechanges'));
    }
}
