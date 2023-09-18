<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HTTP_ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HTTP_ResponseTrait;
    public function login(Request $request){

        $validator=Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);
        if ($validator->fails())
        {
            return $this->errorResponse(false, 'validation error', $validator->errors(), 401);
        }

        if (Auth::attempt($request->only(['email', 'password']))) {

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('token-name')->plainTextToken;

            return $this->successResponse(true, 'User Logged In Successfully', $user, $token, 200);
        }

        else{
            return $this->errorResponse(false, 'Email & Password does not match with our record', 'ERROR', 401);

        }
    }
    public function logout(){
        \auth()->user()->tokens()->delete();
        return response()->json([
            'message'=>'Your logout success'
        ],200);
    }
}
