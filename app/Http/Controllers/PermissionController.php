<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePermission;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionUpdateForm;




class PermissionController extends Controller
{

public function index(){

    $permissions = Permission::select('permissions.name','permissions.created_at','permissions.id')

    ->when(request('searchKey'),function($query){
            $query->whereAny(['permissions.name'], 'like', '%'.request('searchKey').'%');
        })

    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('permission.index',compact('permissions'));
}

public function create(){
    return view('permission.create');
}

public function store(StorePermission $request){

    $permission = new Permission();
    $permission->name = $request->name;
    $permission->save();


    return redirect()->route('permissionManangement.index')->with('create','permission is created successfully');
}

  public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();
        return redirect()->route('permissionManangement.index')->with('success', 'permission deleted.');
    }

    public function edit($id){
        $permission = Permission::findorfail($id);

       return view('permission.edit',compact('permission'));
    }

    public function update($id,PermissionUpdateForm $request){
    $permission = Permission::findorfail($id);


    $permission->name = $request->name;

    $permission->update();


    return redirect()->route('permissionManangement.index')->with('update','permission is updated successfully');
    }



}
