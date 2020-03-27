<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Contact::rules());

        $data = $request->all();
        $data["is_deleted"] = 0;

        $contact = Contact::create($data);

        return redirect()->route('contacts.index')->with('msg' ,'Successfull');
        // return redirect()->route('contacts.index')->with('msg' , trans('contact.controller.successfull_add'));
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
        $contact = Contact::findOrFail($id);

        return view('contacts.edit');
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
        $this->validate($request, Contact::rules(true, $id));

        $data = $request->all();

        $contact = Contact::findOrFail($id);

        $contact->update($data);

        return redirect()->route('contacts.index')->with('msg', 'Successfull');
        // return redirect()->route('contacts.index')->with('msg' , trans('contact.controller.successfull_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return back()->with('msg', 'Successfull');
        // return redirect()->route('contacts.index')->with('msg' , trans('contact.controller.successfull_delete'));
    }

    /*******************************
    *   APi                        *
    ********************************/

    //  Contact list
    public function getContactList(Request $request)
    {
        return response(['data' => Contact::where('user_id', $request->user()->id)->where('is_deleted', 0)->get()], 200);

    }

    public function getContactById(Request $request)
    {
        $contact = Contact::where('id', $request->user()->id)->first();

        return response(['data' => $contact], 200);
    }

    public function saveAddContact(Request $request)
    {
        $this->validate($request, Contact::rules());
        $data = $request->all();

        $data['is_deleted'] = 0;
        $data['user_id'] = $request->user()->id;

        $contact = Contact::create($data);
        $addData = Contact::where('id', $contact->id)->first();

        return response(['data' => $addData], 201);
    }

    public function saveUpdateContact(Request $request)
    {
        $contact = Contact::where('id', $request->input('id'))->first();

        $data = $request->all();

        $contact->update($data);

        return response(['data' => $contact], 200);
    }

    public function deleteContact(Request $request)
    {
        $contact = Contact::where('id', $request->input('id'))->first();

        $response = $contact;
        $data['is_deleted'] = 1;
        $contact->update($data);

        return response(['data' => $response], 201);
    }

}
