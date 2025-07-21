<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RoleUpdateForm;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;




class RoleController extends Controller
{

public function index()
{
    //  if(!auth()->user()->can('view_role') ){
    //   abort(403,'Unauthorized action.');
    // }
    $roles = Role::select(
            'roles.id',
            'roles.name',
            'roles.created_at',
            DB::raw("GROUP_CONCAT(permissions.name SEPARATOR ', ') as permissions")
        )
        ->leftJoin('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
        ->leftJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
        ->when(request('searchKey'), function ($query) {
            $query->where('roles.name', 'like', '%' . request('searchKey') . '%');
        })
        ->groupBy('roles.id', 'roles.name', 'roles.created_at')
        ->orderBy('roles.created_at', 'desc')
        ->paginate(10);

    return view('role.index', compact('roles'));
}

public function create(){
    $permissions = Permission::all();
    return view('role.create',compact('permissions'));
}

public function store(StoreRole $request){
    //  if(!auth()->user()->can('create_role') ){
    //   abort(403,'Unauthorized action.');
    // }

    $role = new Role();
    $role->name = $request->name;
    $role->save();

    $role->givePermissionTo($request->permissions);

    return redirect()->route('roleManangement.index')->with('create','Role is created successfully');
}

  public function destroy($id)
    {
    //      if(!auth()->user()->can('delete_role') ){
    //   abort(403,'Unauthorized action.');
    // }
        $role = Role::findOrFail($id);

        $role->delete();
        return redirect()->route('roleManangement.index')->with('success', 'Role deleted.');
    }

    public function edit($id){
    //      if(!auth()->user()->can('update_role') ){
    //   abort(403,'Unauthorized action.');
    // }
         $permissions = Permission::all();
         $role = Role::findorfail($id);
         $old = $role->permissions->pluck('id')->toArray();

       return view('role.edit',compact('role','permissions','old'));
    }

    public function update($id,RoleUpdateForm $request){
    $role = Role::findorfail($id);
    $role->name = $request->name;
    $role->update();
     $old = $role->permissions->pluck('name')->toArray();
     $role->revokePermissionTo($old);
     $role->givePermissionTo($request->permissions);


    return redirect()->route('roleManangement.index')->with('update','role is updated successfully');
    }



}
