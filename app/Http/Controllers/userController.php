<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\users;

use App\Models\drivers;



class userController extends Controller
{
    //


    public function index(Request $request)
	    {
				if (!$request->has('userId')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'User Id is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('password')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'password is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('lat')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'latitude is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('lon')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'longitude is missing'))->header('Content-Type', 'application/json');
	        }


	    	return users::index($request->all());
	    	    


	    }



	    public function view(Request $request)
		{
	    	return drivers::view($request->all());


	    }

}
