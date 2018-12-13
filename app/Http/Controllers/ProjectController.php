<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

Use App\Level;
Use App\User;
Use App\Project;
Use App\ProjectUser;
Use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate(request(), [
            'requirements' => 'required|string',
            'title' => 'required|string',
            'deadline' => 'required',
        ]);

        $project = new Project;

        $project->instructor_id = Auth::User()->id;
        $project->batch_id = Auth::User()->batch_id;
        $project->project_req = request('requirements');
        $project->project_name = request('title');
        $project->deadline = request('deadline');

        if ($project->save()) {
            echo "success";
        }else{
            echo "error";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id, $level, $instructor)
    {
        if($id == "All"){
            if ($level == 3) {
               $projects = Project::paginate(10);
            }else{
                $projects = Project::whereInstructor_id($instructor)->orderBy('status_id', 'asc')->oldest()->paginate(10);
            }
            Session::flash('All', 'All');
        }
        elseif ($id == "Ongoing") {
            if ($level == 3 ) {
               $projects = Project::whereStatus_id(1)->paginate(10);
            }else{
                $projects = Project::whereStatus_id(1)->whereInstructor_id($instructor)->orderBy('status_id', 'asc')->oldest()->paginate(10);
            }
            Session::flash('Ongoing', 'Ongoing');
        }elseif($id == "Closed"){
            if ($level == 3 ) {
               $projects = Project::whereStatus_id(2)->paginate(10);
            }else{
                $projects = Project::whereStatus_id(2)->whereInstructor_id($instructor)->orderBy('status_id', 'asc')->oldest()->paginate(10);
            }
            Session::flash('Closed', 'Closed');
        }elseif($id == "Received"){
            if ($level == 3 ) {
               $projects = Project::whereStatus_id(3)->paginate(10);
            }else{
                $projects = Project::whereStatus_id(3)->orderBy('status_id', 'asc')->oldest()->paginate(10);
            }
            Session::flash('Received', 'Received');
        }elseif ($id == "Pending") {
            if ($level == 3 ) {
               $projects = Project::whereStatus_id(4)->paginate(10);
            }else{
                $projects = Project::whereStatus_id(4)->whereInstructor_id($instructor)->orderBy('status_id', 'asc')->oldest()->paginate(10);
            }
            Session::flash('Pending', 'Pending');
        }elseif ($id == "Approved"){
            if ($level == 3 ) {
               $projects = Project::whereStatus_id(5)->paginate(10);
            }else{
                $projects = Project::whereStatus_id(5)->whereInstructor_id($instructor)->orderBy('status_id', 'asc')->oldest()->paginate(10);
            }
            Session::flash('Approved', 'Approved');
        }
        $count = count($projects);
        return view('project-list', compact('projects', 'count'));
    }

    public function showReceived($id){
        $instructor = User::whereId($id)->paginate(10);
        $projectSubmits = ProjectUser::whereStatus_id(4)->paginate(10);
        $count = count($projectSubmits);

        return view('project-received-list', compact('projectSubmits','count'));
    }

    public function approveProject($id, Request $request){
        $approveProject = ProjectUser::findOrFail($id);
        $approveProject->status_id = 5;
        if($approveProject->save()){
            echo "success";
        }else{
            echo "error";
        }
            

    }

    public function projectsStudent($batch){
        $stat = [1, 2];
        $projects = Project::whereBatch_id($batch)->whereIn('status_id', $stat)->paginate(5);
/*        foreach($projects as $project){
            $proj = ProjectUser::whereProject_id($project->id)->whereUser_id(Auth::User()->id)->get();
        }*/
        $users = ProjectUser::whereUser_id(Auth::User()->id)->get();
        $count = $projects->count();

        return view('student-project-list', compact('projects', 'count', 'users'));
    }

    public function submitProject($id, $project){
        $projects = Project::findOrFail($project);
        $projects->user()->sync($id);
        $json = json_decode($projects->user, true);
        $batch = $json[0]['batch_id'];
        
        return redirect('/batch-'.$batch.'/projects-list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {   
        $project = Project::findOrFail($id);
        $project->project_name = $request->project_name;
        $project->deadline = $request->deadline;
        $project->project_req = $request->project_req;
        $project->batch_id = $request->batch_id;

        if ($project->save()) {
            echo "success";
        }else{
            echo "error";
        }
    }

    public function close($id, Request $projectId){
        $project = Project::findOrFail($id);
        $project->status_id = 2;
        if ($project->save()) {
            echo 'success';
        }else{
            echo 'failed';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
