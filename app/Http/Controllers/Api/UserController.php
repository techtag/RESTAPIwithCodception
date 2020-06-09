<?php

namespace App\Http\Controllers\Api;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator=Validator::make(
           $request->all(),
           [
               User::NAME => 'required',
               User::EMAIL => 'required',
               User::PASSWORD => 'required',             
           ]
        );
       
       try{
        if ($validator->fails()){
            throw new Exception('Failed',400);
        }   
        $user = new User();
        $user->setAttribute(User::NAME, $request->get(User::NAME));
        $user->setAttribute(User::EMAIL, $request->get(User::EMAIL));
        $user->setAttribute(User::PASSWORD, $request->get(User::PASSWORD));
        $user->save();
        return response('Success'); 
       }catch(Exception $e){
            return response(['message'=>$e->getMessage()],$e->getCode());
       }       
    }

    
}
