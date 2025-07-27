<?php

namespace App\Http\Controllers;

use auth;
use Illuminate\Http\Request;
use App\Models\CheckInCheckOut;

class OwnerAttendanceController extends Controller
{
    public function index(){

     $attendances = CheckInCheckOut::select('check_in_check_outs.user_id','check_in_check_outs.created_at',
    'check_in_check_outs.id','check_in_check_outs.checkin_time','check_in_check_outs.date','check_in_check_outs.checkout_time','users.name as user_name')
    ->leftJoin('users','users.id','check_in_check_outs.user_id')
    ->where('user_id',auth()->user()->id)

    ->orderBy('date','desc')
    ->paginate(10);

    return view('attendance.owner',compact('attendances'));

    }
}
