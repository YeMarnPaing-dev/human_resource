<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{

public function index(){

    $employees = User::select('users.name as user_name','users.email','users.employee_id','users.nrc_number','users.gender','users.is_present',
    'departments.name as department_name')

    ->when(request('searchKey'),function($query){
            $query->whereAny(['users.name','departments.name','users.phone'], 'like', '%'.request('searchKey').'%');
        })
    ->leftJoin('departments','users.department_id','departments.id')
    ->get();

    return view('employee.index',compact('employees'));
}

public function create(){

    $departments = Department::orderBy('name')->get();
    return view('employee.create',compact('departments'));
}




}
