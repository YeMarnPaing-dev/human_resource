<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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

    $projects = Project::select('projects.title','projects.created_at','projects.id','projects.description',
                'projects.start_date','projects.dead_line','projects.priority','projects.status')

    ->when(request('searchKey'),function($query){
            $query->whereAny(['projects.title'], 'like', '%'.request('searchKey').'%');
        })

    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('project.index',compact('projects'));
}

public function create(){
    return view('project.create');
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

       return view('project.edit',compact('project'));
    }

    public function update($id,ProjectUpdateForm $request){
    $project = Project::findorfail($id);

    $project->title = $request->name;
$project->description = $request->description;
$project->start_date = $request->start_date;
$project->dead_line = $request->dead_line;
// $project->images = $imageName; // safe even if null
// $project->files = $file_names ? json_encode($file_names) : null;
$project->priority = $request->priority;
$project->status = $request->status;

    $project->update();


    return redirect()->route('project.index')->with('update','project is updated successfully');
    }



}
