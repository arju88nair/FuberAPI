<?php

namespace App\Models;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    //


	public static function index($input)

	{
		// New User Registration

		$model=new self(); // Instantiating the new self object
		$model->userId=$input['userId'];
		$model->password=$input['password'];
		$model->lat=$input['lat'];
		$model->lon=$input['lon'];
		$uId=$model->uId=md5(uniqid(rand(), true));
		$dt = new DateTime;
		$model->created_at = $dt->format('Y-m-d H:i:s');
		$isSaved=$model->save();

		if($isSaved)
		{


			return response(array('code' => '0', "status" => "success", 'statusCode' => 200, 'message' => 'Successfully registered','uId'=>$uId))->header('Content-Type', 'application/json');


		}
		
		return response(array('code' => '1', "status" => "failure", 'statusCode' => 501, 'message' => 'Try again'))->header('Content-Type', 'application/json');
	}



}
