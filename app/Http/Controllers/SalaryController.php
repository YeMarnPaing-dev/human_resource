<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Salary;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreSalary;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\SalaryUpdateForm;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\DepartmentUpdateForm;



class SalaryController extends Controller
{

public function index(){

    //  if(!auth()->user()->can('View_dept') ){
    //   abort(403,'Unauthorized action.');
    // }

    $salaries = Salary::select('salaries.user_id','salaries.month','salaries.year','salaries.amount','salaries.created_at','salaries.id','users.name as user_name')
    ->leftJoin('users', 'salaries.user_id','users.id')
    ->when(request('searchKey'),function($query){
            $query->whereAny(['user_name'], 'like', '%'.request('searchKey').'%');
        })

    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('salary.index',compact('salaries'));
}

public function create(){
    $employee = User::orderBy('employee_id')->get();
    return view('salary.create',compact('employee'));
}

public function store(StoreSalary $request){

    //  if(!auth()->user()->can('create_dept') ){
    //   abort(403,'Unauthorized action.');
    // }

    $salary = new Salary();
    $salary->user_id = $request->user_id;
    $salary->month = $request->month;
    $salary->year = $request->year;
    $salary->amount = $request->amount;
    $salary->save();


    return redirect()->route('salary.index')->with('create','Salary is created successfully');
}

  public function destroy($id)
    {
    //      if(!auth()->user()->can('delete_dept') ){
    //   abort(403,'Unauthorized action.');
    // }
        $salary = Salary::findOrFail($id);

        $salary->delete();
        return redirect()->route('salary.index')->with('success', 'salary deleted.');
    }

    public function edit($id){
    //      if(!auth()->user()->can('update_dept') ){
    //      abort(403,'Unauthorized action.');
    // }
        $salary = Salary::findorfail($id);
        $employee = User::orderBy('employee_id')->get();

       return view('salary.edit',compact('salary','employee'));
    }

    public function update($id, SalaryUpdateForm $request){
    $salary = Salary::findorfail($id);


    $salary->user_id = $request->user_id;
    $salary->month = $request->month;
    $salary->year = $request->year;
    $salary->amount = $request->amount;
    $salary->update();


    return redirect()->route('salary.index')->with('update','salary is updated successfully');
    }



}
