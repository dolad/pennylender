<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Contact;
use App\User;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts= Contact::all();

        return $this->sendResponse($contacts->toArray(),'Contacts showed successfullly');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $request->all();

        $validator=Validator::make($input,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required'

        ]
        );

        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }else{
            $contact = new Contact;
            $contact->name=$input['name'];
            $contact->phone=$input['phone'];
            $contact->user_id=Auth::id();
            $contact->email=$input['email'];
            $contact->address=$input['address'];
            $saved=$contact->save();
            // $contacts=Contact::create($input);
            if($saved){
                return $this->sendResponse($contact->toArray(), 'Contacts created successfully');
            }

            else{
                return $this->sendError('not saved', 'Contacts created successfully');
            }

                // return response()->json([
                //     'status' => true,
                //     'data'  =>$contact,
                //     'message' => 'Created succesfully'
                // ],200);
            // else
            // return response()->json([
            //     'status' => false,
            //     'data'  =>$contact,
            //     'message' => 'Operation Failed'
            // ],500);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact=Contact::find($id);

        if(is_null($contact)){

            return $this->sendError('contact not found');
        }

        return $this->sendResponse($contact->toArray(), "Contact retrieved successfully");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact){
        $input= $request->all();

        $validator=Validator::make($input, [
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email',
            'address'=>'required'
        ]);

        if($validator->fails()){
             return $this->sendError('Validator error', $this->validate->errors());

        }

        // $user= User::with('contact')->get();

        $contact->name=$input['name'];
        $contact->phone=$input['phone'];
        $contact->user_id=Auth::id();
        $contact->email=$input['email'];
        $contact->address=$input['address'];
        $contact->save();


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact){
        $contact->delete();
        return $this->sendResponse($contact->toArray(),'Contact deleted !! thanks');

    }

    public function sendResponse($result, $message, $code=200){
        $response=[
            'success'=>true,
            'data'=>$result,
            'message'=>$message,
        ];

        return response()->json($response,$code);

    }

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
