<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CheckInCheckOut;

class CheckInOutController extends Controller
{
    public function checkInOut(){

        return view('checkin_checkout');
    }

    public function checkIn(Request $request){

        if(now()->format('D') == 'Sat' || now()->format('D') == 'Sun'){
            return[
                'status' => 'fail',
                'message' => 'Today is off day'
            ];
        }



      $user= User::where('pin_code', $request->pin_code)->firstorfail();

      if(!$user){
          return [
           'status' => 'fail',
           'message'=> 'Pin Code is Wrong'
        ];
      }
      $checkInOutData = CheckInCheckOut::firstOrCreate(
        [
        'user_id' => $user->id,
        'date'=> now()->format('Y-m-d')
             ]
);

if(!is_null($checkInOutData->checkin_time) && !is_null($checkInOutData->checkout_time)){
  return [
           'status' => 'fail',
           'message'=> 'Already Check in and Check out today'
        ];
}

if(is_null($checkInOutData->checkin_time)){
 $checkInOutData->checkin_time = now();
 $message = 'Successfully check in ';

}else{
if(is_null($checkInOutData->checkout_time))
    $checkInOutData->checkout_time = now();
$message = 'Successfully check Out ';

}
      $checkInOutData->update();

      return [
        'status' => 'Success',
        'message'=>$message,
      ];
    }
}
