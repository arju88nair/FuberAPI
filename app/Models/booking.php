<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //


public static function index($input)
{

		// Booking API

		$model=new self();
		$user=$input['uId'];
		$latitude=$input['lat'];
		$longitude=$input['lon'];
		$type=$input['type'];
		$userCheck=users::where('uId','=',$input['uId'])->first();
		if(!$userCheck||empty($userCheck)) // Checking if the said user is present or not
		{
			return response(array('code' => '1', "status" => "failure", 'statusCode' => 501, 'message' => 'User not present'))->header('Content-Type', 'application/json');

		}

		$mainArray=array();
		$drivers=drivers::where('vehType','=',$type)->where('status','=','Active')->get();
		if(!$drivers||empty($drivers))// Checking if there are any active drivers
		{

			return response(array('code' => '1', "status" => "failure", 'statusCode' => 402, 'message' => 'No available drivers around you'))->header('Content-Type', 'application/json');

		}
		foreach ($drivers as $driver)// Finding the distance between the driver ans the user and pushing it to an associative array
		 {

			$distance=self::pythagorus($latitude,$longitude,$driver['lat'],$driver['lon']);
			$array=array('id'=>$driver['regNum'],'distance'=>$distance,'status'=>$driver['status'],'type'=>$driver['vehType']);
			array_push($mainArray, $array);
		}


		//Finding the minimum distance driver
		$object = array_reduce($mainArray, function($a, $b)


		{
	    	return $a['distance'] < $b['distance'] ? $a : $b;

		}, array_shift($mainArray));

		//Saving the said booking


		$model->driverReg=$object['id'];
		$model->userId=$user;
		$time=$model->bookingTime=time();
		$model->type=$object['type'];
		$model->endingTime="";
		$model->fare=0;
		$model->totalDistance=0;
		$model->bookingLat=$latitude;
		$model->bookingLon=$longitude;
		$model->endingLat=0;
		$model->endingLon=0;
		$model->save(); 

		// Updateing the driver status to busy
		$statusChange=drivers::where('regNum','=',$object['id'])->first();
		$statusChange->status="Busy";
		$statusChange->save();


		return response(array('code' => '0', "status" => "success", 'statusCode' => 200, 'message' => 'Your driver will be arriving shortly','details'=>$object,'bookingTime'=>$time))->header('Content-Type', 'application/json');


}


		public static function fare($input)
		{

// Fare calculation API

				$regNum=$input['regNum'];
				$id=$input['uId'];
				$bookingTime=$input['bookingTime'];
				$lat=$input['lat'];
				$lon=$input['lon'];
				$row=self::where('driverReg','=',$regNum)->where('userId','=',$id)->where('bookingTime','=',$bookingTime)->first();
				if(!$row||empty($row))// Fetching the transaction
				{

					return response(array('code' => '1', "status" => "failure", 'statusCode' => 501, 'message' => 'Something went wrong'))->header('Content-Type', 'application/json');
				}


				$distance= self::pythagorus($lat,$lon,$row['bookingLat'],$row['bookingLon']);// Calculating the total distance travelled
				$endingTime=time();

				$time=round((abs($endingTime-$row['bookingTime']))/60);

				$totalFare=round(($time)+($distance*2));

				if($row['type']="Pink")
				{
					$totalFare=round($totalFare+5);
				}

				$row->fare=$totalFare."dogecoins";
				$row->endingTime=$endingTime;
				$row->totalDistance=round($distance);
				$row->endingLat=$input['lat'];
				$row->endingLon=$input['lon'];
				$isSaved=$row->save(); // updating the transaction

				if($isSaved)
				{


						$car=drivers::where('regNum','=',$regNum)->first();// Reverting the driver
						$car->status="Active";
						$car->lat=$lat;
						$car->lon=$lon;
						$car->save();
						return response(array('code' => '0', "status" => "success", 'statusCode' => 200, 'message' => 'Thank you for chosing Fuber','fare'=>$totalFare." dogecoins",'totalDistance'=>round($distance),'timeTaken'=>$time." minute(s)"))->header('Content-Type', 'application/json');


				}



					return response(array('code' => '1', "status" => "failure", 'statusCode' => 501, 'message' => 'Something went wrong'))->header('Content-Type', 'application/json');



		}



		public static function pythagorus($lat1,$lon1,$lat2,$lon2){


// Using Pythagorus theorem

			$horizontal=($lon2 - $lon1) * cos($lat1);
			$vertical=($lat2 - $lat1);
			$distance = sqrt($horizontal * $horizontal + $vertical * $vertical);

// To convert to kms,considering the earth's spherical shape,2 * pi * R / 360 where R is the radius 39559 

			return $distance*111.2017839952;

		}


}
