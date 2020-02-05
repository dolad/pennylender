<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController{
     /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

     public function register(Request $request){
         $validator=Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
         ]);
         if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
     }

     public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            if(auth())

            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;

                return $this->sendResponse($success, 'Login  successfully.');
            }


        else{
            return $this->sendError('Unauthorized',"unauthozed");
        }
        // if(!auth()->attempt($loginData)){
        //     return $this->sendError('Invalid Credentials.', $loginData->errors());
        // }
        // $user=auth()->user();
        // $success['token'] = $user->createToken('MyApp')->accessToken;
        // $success['user']=$user->name;
        // return $this->sendResponse($success, 'User register successfully.');

     }

}
