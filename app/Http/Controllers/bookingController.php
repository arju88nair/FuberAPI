<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\drivers;

use App\Models\booking;



class bookingController extends Controller
{
    //



   public function index(Request $request)
	    {
			if (!$request->has('regNum')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Registration Number is missing'))->header('Content-Type', 'application/json');
	        }
	        
	        if (!$request->has('lat')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Latitude is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('lon')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Longitude is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('type')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Type is missing'))->header('Content-Type', 'application/json');
	        }


	    	return drivers::index($request->all());
	    	    


	    }



	     public function booking(Request $request)
	    {
			if (!$request->has('uId')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'uniqid is missing'))->header('Content-Type', 'application/json');
	        }
	        
	        if (!$request->has('lat')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Latitude is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('lon')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Longitude is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('type')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Type is missing'))->header('Content-Type', 'application/json');
	        }


	    	return booking::index($request->all());
	    	    


	    }


	  	 public function fare(Request $request)
	    {
			if (!$request->has('uId')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'uniqid is missing'))->header('Content-Type', 'application/json');
	        }
	        
	        if (!$request->has('bookingTime')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Booking Time is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('regNum')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Registration Number is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('lat')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Latitude is missing'))->header('Content-Type', 'application/json');
	        }
	        if (!$request->has('lon')) {
	            return response(array('code' => '1', "status" => "failure", 'statusCode' => 401, 'message' => 'Longitude is missing'))->header('Content-Type', 'application/json');
	        }

	    	return booking::fare($request->all());
	    	    


	    }




}
