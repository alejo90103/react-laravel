<?php
# @Author: Codeals
# @Date:   22-11-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 07-12-2019
# @Copyright: Codeals

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::where('is_deleted', 0)->get();

        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = array('Cell' => 'Cell', 'Nauta' => 'Nauta');
        return view('offers.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, Offer::rules());

        $data = $request->all();
        if (isset($request->ads) && $request->ads == 'on') {
          $data['ads'] = 1;
        } else {
          $data['ads'] = 0;
        }
        $data["is_deleted"] = 0;

        $offer = Offer::create($data);

        return redirect()->route('offers.index')->with('msg' ,'Successfull');
        // return redirect()->route('offers.index')->with('msg' , trans('offer.controller.successfull_add'));
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
        $offer = Offer::findOrFail($id);

        $types = array('Cell' => 'Cell', 'Nauta' => 'Nauta');
        return view('offers.edit', compact('offer', 'types'));
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
        $this->validate($request, Offer::rules(true, $id));

        $data = $request->all();

        $offer = Offer::findOrFail($id);

        $offer->update($data);

        return redirect()->route('offers.index')->with('msg', 'Successfull');
        // return redirect()->route('offers.index')->with('msg' , trans('offer.controller.successfull_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        $data['is_deleted'] = 1;
        $offer->update($data);
        //$offer->delete();

        return back()->with('msg', 'Successfull');
        // return redirect()->route('offers.index')->with('msg' , trans('offer.controller.successfull_delete'));
    }

    /*******************************
    *   APi                        *
    ********************************/

    //  Offer list
    public function allOffer()
    {
        //  aqui se formo la cosa, redsys y recojo y dingconnect
        $NOW = date('Y-m-d');

        $data = Offer::where('is_deleted', '=', 0)
                    ->where('date_ini', '<=', $NOW)
                    ->where('date_end', '>=', $NOW)
                    ->where('type', '=', 'Cell')
                    ->where('ads', '=', 1)
                    ->get();

        if (!$data->isEmpty()) {
            return response(['data' => $data], 200);
        }

        $data = Offer::where('is_deleted', '=', 0)
                    ->where('date_end', '>=', $NOW)
                    ->get();

        return response(['data' => $data], 200);
    }

    static public function apiIndex()
    {
        $offers = Offer::all();

        return $offers;
    }
}
