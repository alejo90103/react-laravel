<?php
# @Author: Codeals
# @Date:   05-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 31-12-2019
# @Copyright: Codeals

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mail\ForgotPassword;
use App\Mail\RegisterUser;
use App\Mail\WelcomeUser;
use App\Token;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = array('1' => 'Admin');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, User::rules());

        $data = $request->all();

        $passw = mb_split('@', $data["email"]);
        $data["password"] = Hash::make($passw[0]);

        $user = User::create($data);

        return redirect()->route('users.index')->with('msg' ,'Successfull');
        // return redirect()->route('users.index')->with('msg' , trans('user.controller.successfull_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        //dd($user);
        // return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
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
        $data = $request->all();

        $user = User::findOrFail($id);

        $user->update($data);

        return redirect()->route('users.index')->with('msg', 'Successfull');
        // return redirect()->route('users.index')->with('msg' , trans('user.controller.successfull_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (Auth::id() == $id) {
            return back()->with('err', "error");
        }

        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('msg', 'Successfull');
        // return redirect()->route('users.index')->with('msg' , trans('user.controller.successfull_delete'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $user = Auth::user();
        return view('users.change', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storePassword(Request $request)
    {
        $users = User::find(Auth::id());

        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        //$users->is_deleted = 0;

        $users->password = Hash::make($request->password);
        $users->save();

        return redirect()->route('/')->with('msg', trans('user.controller.successfull_change'));
    }

    /*******************************
    *   APi                        *
    ********************************/
    public function getUserList()
    {
        return response(['data' => User::all()], 200);
    }

    /**
     * Handling the register user request
     */
    public function registerPassword(Request $request)
    {
        $data = $request->all();

        $user = User::where('email', '=', $request->input('email'))->first();

        if ($user) return response(['data' => 'Este usuario ya existe'], 430);


        $data['password'] = Hash::make($request->input('password'));
        $data['admin'] = 0;
        $data['status'] = 1;

        $user = User::create($data);
        $newUser = User::where('id', $user->id)->first();

        if (!$newUser) {
            return response(['data' => 'Something wrong :('], 500);
        }

        // $token = Token::create([
        //     'user_id' => $newUser->id,
        //     'token' => uniqid(),
        //     'expire_at' => Carbon::now()->addHour(),
        // ]);
        //
        // Mail::to($newUser)->send(new RegisterUser($token, $request));

        Mail::to($newUser)->send(new WelcomeUser($request));

        return response(['data' => 'Email sent.'], 201);
    }

    /**
     * Handling the active user request
     */
    public function activeUser(Request $request)
    {
        $token = $request->input('token');
        $dBToken = DB::table('tokens')
            ->where('token', $token)
            ->where('expire_at', '>', Carbon::now())
            ->first();

        if (!$dBToken) {
            return response(['data' => 'Wrong token.'], 403);
        }

        $user = User::where('id', $dBToken->user_id)->first();
        $user->status = 1;
        $user->save();

        DB::table('tokens')->where('id', $dBToken->id)->delete();

        return response(['data' => 'User active.'], 201);
    }

    /**
     * Handling the forgot password email request
     */
    public function forgotPassword(Request $request)
    {
        $users = User::where('email', $request->input('email'))->get();

        if ($users->isEmpty()) {
            return response(['data' => 'Check if the email is correct'], 403);
        }

        $user = $users[0];

        $token = Token::create([
            'user_id' => $user->id,
            'token' => uniqid(),
            'expire_at' => Carbon::now()->addHour(),
        ]);

        Mail::to($user)->send(new ForgotPassword($token, $request));

        return response(['data' => 'Email sent.'], 200);
    }

    /**
     * Hanlding the request to reset the password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['data' => $validator->errors()], 433);
        }

        $token = $request->input('token');
        $dBToken = DB::table('tokens')
            ->where('token', $token)
            ->where('expire_at', '>', Carbon::now())
            ->first();

        if (!$dBToken) {
            return response(['data' => 'Wrong token.'], 403);
        }

        $user = User::where('id', $dBToken->user_id)->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        DB::table('tokens')->where('id', $dBToken->id)->delete();

        return response(['data' => 'Password changed.'], 200);
    }

    //  change password
    public function changePasswordApi(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        $data['password'] = Hash::make($request->input('password'));
        $user->update($data);

        return response(['data' => $user], 200);
    }
}
