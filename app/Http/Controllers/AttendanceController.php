<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CheckInCheckOut;
use App\Http\Requests\StoreAttendance;
use App\Http\Requests\UpdateAttendance;

class AttendanceController extends Controller
{
    public function index(){

    //  if(!auth()->user()->can('View_dept') ){
    //   abort(403,'Unauthorized action.');
    // }

    $attendances = CheckInCheckOut::select('check_in_check_outs.user_id','check_in_check_outs.created_at',
    'check_in_check_outs.id','check_in_check_outs.checkin_time','check_in_check_outs.date','check_in_check_outs.checkout_time','users.name as user_name')
    ->leftJoin('users','users.id','check_in_check_outs.user_id')
    ->when(request('searchKey'),function($query){
       $query->whereAny(['users.name','check_in_check_outs.date'], 'like', '%'.request('searchKey').'%');
        })

    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('attendance.index',compact('attendances'));
}

public function create(){
    $employee = User::orderBy('employee_id')->get();
    return view('attendance.create',compact('employee'));
}

public function store(StoreAttendance $request){

    //  if(!auth()->user()->can('create_dept') ){
    //   abort(403,'Unauthorized action.');
    // }

    if( CheckInCheckOut::where('user_id', $request->user_id)->where('date', $request->date)->exists()){
        return back()->withErrors(['fail'=> 'Already Taken'])->withInput();
    }

    $attendance = new CheckInCheckOut();
    $attendance->user_id = $request->user_id;
    $attendance->date = $request->date;
    $attendance->checkin_time = $request->date . ' ' . $request->checkin_time;
    $attendance->checkout_time = $request->date . ' ' . $request->checkout_time;
    $attendance->save();


    return redirect()->route('attendance.index')->with('create','attendance is created successfully');
}

  public function destroy($id)
    {
    //      if(!auth()->user()->can('delete_dept') ){
    //   abort(403,'Unauthorized action.');
    // }
        $attendance = CheckInCheckOut::findOrFail($id);

        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'attendance deleted.');
    }

    public function edit($id){
    //      if(!auth()->user()->can('update_dept') ){
    //      abort(403,'Unauthorized action.');
    // }
        $attendance = CheckInCheckOut::findorfail($id);
        $employee = User::orderBy('employee_id')->get();

       return view('attendance.edit',compact('attendance','employee'));
    }

    public function update($id, UpdateAttendance $request){

    $attendance = CheckInCheckOut::findorfail($id);


     if( CheckInCheckOut::where('user_id', $request->user_id)->where('date', $request->date)->where('id', '!=' , $attendance->id )->exists()){
        return back()->withErrors(['fail'=> 'Already Taken'])->withInput();
    }

    $attendance->user_id = $request->user_id;
    $attendance->date = $request->date;
    $attendance->checkin_time = $request->date . ' ' . $request->checkin_time;
    $attendance->checkout_time = $request->date . ' ' . $request->checkout_time;


    $attendance->update();


    return redirect()->route('attendance.index')->with('update','attendance is updated successfully');
    }
}
