<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RoleUpdateForm;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;




class RoleController extends Controller
{

public function index(){

    $roles = Role::select('roles.name','roles.created_at','roles.id')

    ->when(request('searchKey'),function($query){
            $query->whereAny(['roles.name'], 'like', '%'.request('searchKey').'%');
        })

    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('role.index',compact('roles'));
}

public function create(){
    return view('role.create');
}

public function store(StoreRole $request){

    $role = new Role();
    $role->name = $request->name;
    $role->save();


    return redirect()->route('roleManangement.index')->with('create','Role is created successfully');
}

  public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();
        return redirect()->route('roleManangement.index')->with('success', 'Role deleted.');
    }

    public function edit($id){
        $role = Role::findorfail($id);

       return view('role.edit',compact('role'));
    }

    public function update($id,RoleUpdateForm $request){
    $role = Role::findorfail($id);


    $role->name = $request->name;

    $role->update();


    return redirect()->route('roleManangement.index')->with('update','role is updated successfully');
    }



}
