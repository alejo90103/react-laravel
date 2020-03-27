<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
  protected $user;

  public function __construct()
  {
    $this->user = new User;
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'firstname'=>'required|string',
      'lastname'=>'required|string',
      'email'=>'required|string',
      'password'=>'required|string|min:6'
    ]);

    if ($validator->fails()){
      return response()->json([
        'success'=>false,
        'message'=>$validator->messages()->toArray()
      ], 400);
    }

    $check_email = $this->user->where('email', $request->email)->count();
    if ($check_email > 0 ) {
      return response()->json([
        'success'=>false,
        'message'=>'This email already exist'
      ], 401);
    }

    $registerComplete = $this->user::create([
      'firstname'=>$request->firstname,
      'lastname'=>$request->lastname,
      'email'=>$request->email,
      'password'=>$request->password
    ]);

    if ($registerComplete) {
      $this->login($request);
    }
  }
}
