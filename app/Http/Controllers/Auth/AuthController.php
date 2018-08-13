<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller

{


    public $successStatus = 200;


    /**

     * login api

     *

     * @return \Illuminate\Http\Response

     */

    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();

            $tokenResult = $user->createToken('MyApp');
            $token = $tokenResult->token;
            $token->expires_at = now()->addMinutes(1);
            $token->save();

            $success['token'] = $tokenResult->accessToken;
            $success['token_expires_at'] = $token->expires_at;
            $success['name'] =  $user->name;

            return response()->json(['success' => $success], $this->successStatus);

        }
        else{

            return response()->json(['error'=>'Unauthorised'], 401);

        }

    }


    /**

     * Register api

     *

     * @return \Illuminate\Http\Response

     */

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);

        }


        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $tokenResult = $user->createToken('MyApp');
        $token = $tokenResult->token;
        $token->expires_at =now()->addMinutes(1);
        $token->save();

        $success['token'] = $token;
        $success['token_expires_at'] = $token->expires_at;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);

    }


    /**

     * details api

     *

     * @return \Illuminate\Http\Response

     */

    public function details()

    {

        $user = Auth::user();

        return response()->json(['success' => $user], $this->successStatus);

    }

}