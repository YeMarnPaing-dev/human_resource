<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ProjectLeader;
use App\Models\ProjectMember;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProject;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreDepartment;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProjectUpdateForm;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\DepartmentUpdateForm;



class ProjectController extends Controller
{

public function index(){

    //  if(!auth()->user()->can('View_dept') ){
    //   abort(403,'Unauthorized action.');
    // }

    $employees = User::orderBy('name')->get();



$projects = Project::select(
        'projects.title',
        'projects.created_at',
        'projects.id',
        'projects.description',
        'projects.start_date',
        'projects.dead_line',
        'projects.priority',
        'projects.status',
        'users.name as leader_name',
        DB::raw('GROUP_CONCAT(members.name SEPARATOR ",") as member_name')
    )
    ->join('project_leaders', 'projects.id', '=', 'project_leaders.project_id')
    ->join('users', 'project_leaders.user_id', '=', 'users.id')
    ->leftJoin('project_members', 'projects.id', '=', 'project_members.project_id')
    ->leftJoin('users as members', 'project_members.user_id', '=', 'members.id')
    ->groupBy(
        'projects.id',
        'projects.title',
        'projects.created_at',
        'projects.description',
        'projects.start_date',
        'projects.dead_line',
        'projects.priority',
        'projects.status',
        'users.name'
    )
    ->when(request('searchKey'), function ($query) {
        $query->where('projects.title', 'like', '%' . request('searchKey') . '%');
    })
    ->orderBy('projects.created_at', 'desc')
    ->paginate(10);

    return view('project.index',compact('projects','employees'));
}

public function create(){
    $employees = User::orderBy('name')->get();
    return view('project.create',compact('employees'));
}

public function store(StoreProject $request){

    //  if(!auth()->user()->can('create_dept') ){
    //   abort(403,'Unauthorized action.');
    // }
//     $imageName = null;
// if ($request->hasFile('image')) {
//     $image = $request->file('image');

//     if ($image->isValid()) {
//         $imageName = uniqid() . '_' . $image->getClientOriginalName();
//         $image->move(public_path('project'), $imageName);
//     }
// }

// dd($request->toArray());

$project = new Project();
$project->title = $request->name;
$project->description = $request->description;
$project->start_date = $request->start_date;
$project->dead_line = $request->dead_line;
// $project->images = $imageName; // safe even if null
// $project->files = $file_names ? json_encode($file_names) : null;
$project->priority = $request->priority;
$project->status = $request->status;
$project->save();

foreach(($request->leaders ?? []) as $leader){
    $project_leader = new ProjectLeader;
    $project_leader->project_id = $project->id;
    $project_leader->user_id = $leader;
    $project_leader->save();

}

foreach(($request->members ?? []) as $member){
    $project_member = new ProjectMember;
    $project_member->project_id = $project->id;
    $project_member->user_id = $member;
    $project_member->save();

}


    return redirect()->route('project.index')->with('create','project is created successfully');
}

  public function destroy($id)
    {
    //      if(!auth()->user()->can('delete_dept') ){
    //   abort(403,'Unauthorized action.');
    // }
        $project = Project::findOrFail($id);

        $project->delete();
        return redirect()->route('project.index')->with('success', 'project deleted.');
    }

    public function edit($id){
    //      if(!auth()->user()->can('update_dept') ){
    //      abort(403,'Unauthorized action.');
    // }
        $project = Project::findorfail($id);
        $employees = User::orderBy('name')->get();


       return view('project.edit',compact('project','employees'));
    }

   public function update($id, ProjectUpdateForm $request)
{
    $project = Project::findOrFail($id);

    // Update basic project fields
    $project->title = $request->name;
    $project->description = $request->description;
    $project->start_date = $request->start_date;
    $project->dead_line = $request->dead_line;
    // $project->images = $imageName;
    // $project->files = $file_names ? json_encode($file_names) : null;
    $project->priority = $request->priority;
    $project->status = $request->status;
    $project->update();



    return redirect()->route('project.index')->with('update', 'Project is updated successfully');
}



}
