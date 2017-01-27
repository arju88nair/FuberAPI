<?php

namespace App\Models;
use DateTime;
use View;

use Illuminate\Database\Eloquent\Model;

class drivers extends Model
{
    //


	public static function index($input)
	{



		//Driver Registration 
		
		$model=new self();
		$model->regNum=$input['regNum'];
		$model->lat=$input['lat'];
		$model->lon=$input['lon'];
		$model->status="Active";	
		$model->vehType=$input['type'];
		$dt = new DateTime;
		$model->created_at = $dt->format('Y-m-d H:i:s');
		$model->updated_at = $dt->format('Y-m-d H:i:s');
		$isSaved=$model->save();
		if($isSaved)
		{
			return response(array('code' => '0', "status" => "success", 'statusCode' => 200, 'message' => 'Successfully registered','regNum'=>$input['regNum']))->header('Content-Type', 'application/json');

		}
		  return response(array('code' => '1', "status" => "failure", 'statusCode' => 501, 'message' => 'Try again'))->header('Content-Type', 'application/json');




}


	public static function view($input)
	{



		$drivers=self::all();
		return View::make('view')->with('drivers',$drivers);


	}





}
