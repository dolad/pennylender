<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Contact;
use App\User;

class contactsController extends Controller
{
    public function saveMe(Request $request)
    {
        $input= $request->all();
        return $input; die;

        $validator= Validator::make($input,[
            'name'=>'required',
            'phonenumber'=>'required',
            'email'=>'required',
            'address'=>'required'

        ]
        );

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $contacts=Contact::create($input);

        return response()->sendResponse($contacts->toArray(), 'Contacts created successfully');

    }
}
