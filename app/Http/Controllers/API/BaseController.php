<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller{
     /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code=200){
        $response=[
            'success'=>true,
            'data'=>$result,
            'message'=>$message,
        ];

        return response()->json($response,$code);

    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessage=[], $code=404){

        $response=[
            'success'=>false,
            'message'=>$error,
        ];

        if(!empty($errorMessage)){
            $response['data']=$errorMessage;
        }

        return response()->json($response, $code);
    }


}




