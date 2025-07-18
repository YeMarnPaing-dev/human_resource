<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDepartment;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\DepartmentUpdateForm;



class DepartmentController extends Controller
{

public function index(){

     if(!auth()->user()->can('View_dept') ){
      abort(403,'Unauthorized action.');
    }

    $departments = Department::select('departments.name','departments.created_at','departments.id')

    ->when(request('searchKey'),function($query){
            $query->whereAny(['departments.name'], 'like', '%'.request('searchKey').'%');
        })

    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('department.index',compact('departments'));
}

public function create(){
    return view('department.create');
}

public function store(StoreDepartment $request){

     if(!auth()->user()->can('create_dept') ){
      abort(403,'Unauthorized action.');
    }

    $department = new Department();
    $department->name = $request->name;
    $department->save();


    return redirect()->route('departmentManangement.index')->with('create','Department is created successfully');
}

  public function destroy($id)
    {
         if(!auth()->user()->can('delete_dept') ){
      abort(403,'Unauthorized action.');
    }
        $department = Department::findOrFail($id);

        $department->delete();
        return redirect()->route('departmentManangement.index')->with('success', 'Department deleted.');
    }

    public function edit($id){
         if(!auth()->user()->can('update_dept') ){
         abort(403,'Unauthorized action.');
    }
        $department = Department::findorfail($id);

       return view('department.edit',compact('department'));
    }

    public function update($id, DepartmentUpdateForm $request){
    $department = Department::findorfail($id);


    $department->name = $request->name;

    $department->update();


    return redirect()->route('departmentManangement.index')->with('update','Department is updated successfully');
    }



}
