<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UpdateForm;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;



class EmployeeController extends Controller
{

public function index(){

    $employees = User::select('users.*','users.name as user_name','users.email','users.phone','users.employee_id','users.nrc_number','users.gender','users.is_present','users.created_at','users.updated_at',
    'departments.name as department_name')

    ->when(request('searchKey'),function($query){
            $query->whereAny(['users.name','departments.name','users.phone'], 'like', '%'.request('searchKey').'%');
        })
    ->leftJoin('departments','users.department_id','departments.id')
    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('employee.index',compact('employees'));
}

public function create(){

    $departments = Department::orderBy('name')->get();
    return view('employee.create',compact('departments'));
}

public function store(StoreEmployee $request){

    $employee = new User();
    $employee->employee_id = $request->employee_id;
    $employee->name = $request->name;
    $employee->email = $request->email;
    $employee->phone = $request->phone;
    $employee->nrc_number = $request->nrc_number;
    $employee->birthday = $request->birthday;
    $employee->gender = $request->gender;
    $employee->address = $request->address;
    $employee->department_id = $request->department_id;
    $employee->date_of_join = $request->dateOfJoin;
    $employee->is_present = $request->is_present;
    $employee->password = Hash::make($request->password);
    $employee->save();


    return redirect()->route('employeeManangement.index')->with('create','Employee is created successfully');
}

  public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->route('employeeManangement.index')->with('success', 'Employee deleted.');
    }

    public function edit($id){
        $employee = User::findorfail($id);
        $departments = Department::orderBy('name')->get();
       return view('employee.edit',compact('departments','employee'));
    }

    public function update($id, UpdateForm $request){
    $employee =User::findorfail($id);
    $employee->employee_id = $request->employee_id;
    $employee->name = $request->name;
    $employee->email = $request->email;
    $employee->phone = $request->phone;
    $employee->nrc_number = $request->nrc_number;
    $employee->birthday = $request->birthday;
    $employee->gender = $request->gender;
    $employee->address = $request->address;
    $employee->department_id = $request->department_id;
    $employee->date_of_join = $request->dateOfJoin;
    $employee->is_present = $request->is_present;
    // $employee->password =$request->password ?  Hash::make($request->password) : $employee->password;
    $employee->update();


    return redirect()->route('employeeManangement.index')->with('update','Employee is updated successfully');
    }
}
