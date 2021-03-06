<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Project;
use App\Team;
use App\JoinRequest;
use App\File;
use DB;
class ProjectsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at','desc')->paginate(10);
        return view('projects.index')->with('projects',$projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required'
        ]);
    
        //Create Project
        $project = new Project;
        $team = new Team;
        $project->project_title = $request->input('title');
        $project->project_description = $request->input('description');
        $project->user_id =  auth()->user()->id;
        $team->user_id = auth()->user()->id;
        $project->save();
        $team->project_id = $project->id;
        $team->save();
        return redirect('/projects')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project =  Project::find($id);
        if(Auth::user()){
            $user_id = auth()->user()->id;
            $joinrequest = JoinRequest::where('project_id','=', $id )
                            ->where('requester_id','=',$user_id)
                            ->get();
            $member_exist = Team::where('user_id',$user_id)
                                  ->where('project_id',$id)
                                  ->get();
            return view('projects.show')->with('project',$project)->with('joinrequest',$joinrequest)->with('member_exist',$member_exist);    
        }
        else{
            return view('projects.show')->with('project',$project);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $project =  Project::find($id);
        //check for correct user
        if(auth()->user()->id !== $project->user_id){
            return redirect('/projects')->with('error','Unauthorized Page');
        }

        return view('projects.edit')->with('project',$project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required'
        ]);
    
        //Create Project
        $project = Project::find($id);
        $project->project_title = $request->input('title');
        $project->project_description = $request->input('description');
        $project->user_id = auth()->user()->id;
        $project->save();

        return redirect('/projects')->with('success','Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if(auth()->user()->id !== $project->user_id){
            return redirect('/projects')->with('error','Unauthorized Page');
        }

        $files = File::where('project_id','=',$id)->get();
        $members = Team::where('project_id','=',$id)
                        ->where('user_id','<>',auth()->user()->id)->get();
        if(count($members)>0)
        {
            return redirect('/dashboard')->with('error','Deletion failed: Projects cannot be deleted if there are remaining members left');
        }                
        if(count($files)>0)
        {
            return redirect('/dashboard')->with('error','Deletion failed: This project has existing file/files');
        }
        
        $project->delete();
        $team_project = DB::table('teams')->where('project_id','=',$id)->delete();
        return redirect('/projects')->with('success','Project Removed');
    }
}
