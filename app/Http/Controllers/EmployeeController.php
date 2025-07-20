<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UpdateForm;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;



class EmployeeController extends Controller
{

public function index(){

    if(!auth()->user()->can('view_employee') ){
      abort(403);
    }

   $employees = User::select(
        'users.id',
        'users.name as user_name',
        'users.email',
        'users.phone',
        'users.employee_id',
        'users.nrc_number',
        'users.gender',
        'users.is_present',
        'users.created_at',
        'users.updated_at',
        'departments.name as department_name',
        DB::raw("GROUP_CONCAT(roles.name SEPARATOR ', ') as role_names")
    )
    ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
    ->leftJoin('model_has_roles', function($join) {
        $join->on('users.id', '=', 'model_has_roles.model_id')
             ->where('model_has_roles.model_type', '=', User::class);
    })
    ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
    ->when(request('searchKey'), function($query) {
        $searchKey = '%' . request('searchKey') . '%';
        $query->where(function ($q) use ($searchKey) {
            $q->where('users.name', 'like', $searchKey)
              ->orWhere('departments.name', 'like', $searchKey)
              ->orWhere('users.phone', 'like', $searchKey)
              ->orWhere('roles.name', 'like', $searchKey);
        });
    })
    ->groupBy(
        'users.id',
        'users.name',
        'users.email',
        'users.phone',
        'users.employee_id',
        'users.nrc_number',
        'users.gender',
        'users.is_present',
        'users.created_at',
        'users.updated_at',
        'departments.name'
    )
    ->orderBy('users.created_at', 'desc')
    ->paginate(10);

    return view('employee.index',compact('employees'));
}

public function create(){

    $departments = Department::orderBy('name')->get();
    $roles = Role::all();
    return view('employee.create',compact('departments','roles'));
}

public function store(StoreEmployee $request){

  if($request->hasFile('image')){
    $fileName = uniqid()  . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path()."/employee/", $fileName);

  }

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
    $employee->profile_img = $fileName;
    $employee->pin_code = $request->pincode;
    $employee->is_present = $request->is_present;
    $employee->password = Hash::make($request->password);
    $employee->save();

    $employee ->syncRoles($request->roles);

    return redirect()->route('employeeManangement.index')->with('create','Employee is created successfully');
}

  public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $oldImage = User::where('id',$id)->value('profile_img');
        // dd($oldImage);
       if(file_exists(\public_path('employee/'.$oldImage))){ //delete if old image exist
        unlink(public_path('employee/'.$oldImage));}
        $employee->delete();
        return redirect()->route('employeeManangement.index')->with('success', 'Employee deleted.');
    }

    public function edit($id){
        $employee = User::findorfail($id);
        $departments = Department::orderBy('name')->get();
        $old = $employee->roles->pluck('id')->toArray();
        $roles = Role::all();
       return view('employee.edit',compact('departments','employee','roles','old'));
    }

    public function update($id, UpdateForm $request){
    $employee =User::findorfail($id);
if ($request->hasFile('image')) {
    $oldImage = $employee->profile_img; // get from DB, not from request

    // Delete old image if it exists
    $oldImagePath = public_path('employee/' . $oldImage);
    if ($oldImage && file_exists($oldImagePath)) {
        unlink($oldImagePath);
    }

    // Upload new image
    $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('employee'), $fileName);

    $employee->profile_img = $fileName;
}

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
    $employee->pin_code =  $request->pincode;
    $employee->is_present = $request->is_present;
    // $employee->password =$request->password ?  Hash::make($request->password) : $employee->password;
    $employee->update();

    $employee ->syncRoles($request->roles);


    return redirect()->route('employeeManangement.index')->with('update','Employee is updated successfully');
    }

    public function show($id){
        $employee = User::findorFail($id);

        return view('employee.showDetail',compact('employee'));
    }

    public function profile(){
        $employee = Auth::user();

        return view('admin.showDetail',compact('employee'));
    }


}
