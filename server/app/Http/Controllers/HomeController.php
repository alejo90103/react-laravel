<?php
# @Author: Codeals
# @Date:   21-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Offer;
use App\Recharge;
use App\ContactRecharge;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main');
    }

    public static function dashboard()
    {
        $Offers = Offer::all();
        $users = User::all();
        $recharges = Recharge::all();

        $dashboard['offers'] = $Offers;
        $dashboard['users'] = $users;
        $dashboard['recharges'] = $recharges;

        return $dashboard;
    }

    public static function dashboardChart($date_year)
    {

        $year[0][0] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-01-'.'%')->get());
        $year[0][1] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-02-'.'%')->get());
        $year[0][2] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-03-'.'%')->get());
        $year[0][3] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-04-'.'%')->get());
        $year[0][4] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-05-'.'%')->get());
        $year[0][5] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-06-'.'%')->get());
        $year[0][6] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-07-'.'%')->get());
        $year[0][7] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-08-'.'%')->get());
        $year[0][8] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-09-'.'%')->get());
        $year[0][9] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-10-'.'%')->get());
        $year[0][10] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-11-'.'%')->get());
        $year[0][11] = count(DB::table('recharges')->where('status', '=', 'Accepted')->where('created_at', 'like', $date_year.'-12-'.'%')->get());


        // $year[1][0] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-01-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][1] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-02-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][2] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-03-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][3] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-04-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][4] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-05-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][5] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-06-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][6] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-07-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][7] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-08-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][8] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-09-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][9] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-10-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][10] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-11-'.'%')->where('is_engine', '=', 1)->get());
        // $year[1][11] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-12-'.'%')->where('is_engine', '=', 1)->get());

        $year[1] = count(DB::table('recharges')->where('created_at', 'like', $date_year.'-'.'%')->get());

        // $total_engine = count(DB::table('recharges')->where('created_at', 'like', $date_year.'%')->where('is_engine', '=', 1)->get());
        // $total_out = count(DB::table('recharges')->where('created_at', 'like', $date_year.'%')->get());
        //
        // $total = $total_engine + $total_out;
        // $total_engine_send = 0;
        // $total_out_send = 0;
        //
        // if ($total > 0) {
        //     $total_engine_send = ($total_engine * 100)/$total;
        //     $total_out_send = ($total_out * 100)/$total;
        // }
        //
        // $year[4] = $total_engine_send;
        // $year[5] = $total_out_send;

        return $year;
    }

    public static function getRecharge()
    {
        $date_year = date('Y');

        // cantidad de recargas en offertas por mes
        $year[0][0] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-01-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][1] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-02-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][2] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-03-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][3] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-04-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][4] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-05-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][5] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-06-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][6] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-07-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][7] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-08-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][8] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-09-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][9] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-10-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][10] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-11-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());
        $year[0][11] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-12-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 1)
                      ->get());

        // cantidad de recargas sin offertas por mes
        $year[1][0] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-01-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][1] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-02-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][2] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-03-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][3] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-04-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][4] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-05-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][5] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-06-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][6] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-07-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][7] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-08-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][8] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-09-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][9] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-10-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][10] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-11-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());
        $year[1][11] = count(DB::table('contact_recharges')->join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                      ->join('offers', 'offers.id', '=', 'recharges.offer_id')
                      ->where('recharges.created_at', 'like', $date_year.'-12-'.'%')
                      ->where('recharges.status', '=', 'Accepted')
                      ->where('offers.ads', '=', 0)
                      ->get());

        // ganancias generales y por mes
        $year[2] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][0] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-01-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][1] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-02-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][2] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-03-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][3] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-04-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][4] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-05-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][5] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-06-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][6] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-07-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][7] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-08-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][8] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-09-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][9] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-10-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][10] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-11-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        $year[5][11] = Recharge::join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('recharges.created_at', 'like', $date_year.'-12-'.'%')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        // estado de las recargas realizadas
        $year[3]["accepted"] = ContactRecharge::join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                        ->where('status', '=', 'Accepted')->count();
        $year[3]["cancel"] = ContactRecharge::join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                        ->where('status', '=', 'Cancel')->count();
        $year[3]["denied"] = ContactRecharge::join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                        ->where('status', '=', 'Denied')->count();
        $year[3]["waiting"] = ContactRecharge::join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                        ->where('status', '=', 'Waiting')->count();
        $year[3]["scheduled"] = ContactRecharge::join('recharges', 'recharges.id', '=', 'contact_recharges.recharge_id')
                        ->where('status', '=', 'Scheduled')->count();

        // ganancias generales por tipo de recarga
        $year[4]["Cell"] = Offer::join('recharges', 'recharges.offer_id', '=', 'offers.id')
                    ->join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('offers.type', '=', 'Cell')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');
        $year[4]["Nauta"] = Offer::join('recharges', 'recharges.offer_id', '=', 'offers.id')
                    ->join('contact_recharges', 'contact_recharges.recharge_id', '=', 'recharges.id')
                    ->where('offers.type', '=', 'Nauta')
                    ->where('recharges.status', '=', 'Accepted')
                    ->where('contact_recharges.is_deleted', '=', 0)
                    ->sum('recharges.price_pay');

        // dd($year);

        return $year;
    }
}
