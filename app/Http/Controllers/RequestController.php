<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Team;
use App\JoinRequest;
use DB;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => []]);
    }


    public function index()
    {
    //    $user_id = auth()->user()->id;
    //    $users_team = DB::table('teams')
    //                 ->select('projects.id','projects.project_title')
    //                 ->join('projects','projects.id', '=','teams.project_id')
    //                 ->where('teams.user_id', $user_id)
    //                 ->get();
    //    return $users_team;
          return redirect('/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $project = Project::find($id);
        return view('request.create')->with('project',$project);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $JoinRequest = new JoinRequest;
        
        $this->validate($request,[
            'coverletter' => 'required'
        ]);
        $requester_id = auth()->user()->id;
        $cover_letter =  $request->input('coverletter');
        $project_id = $request->input('id');
        $data = DB::table('projects')
                    ->select('user_id')
                    ->where('id', '=', $project_id)
                    ->first();   
        $creator_id = $data->user_id;    
        $JoinRequest->creator_id =  $creator_id;  
        $JoinRequest->project_id = $project_id;
        $JoinRequest->requester_id = $requester_id;
        $JoinRequest->coverletter = $cover_letter;
        $JoinRequest->save(); 
        return redirect('/projects')->with('success','Request has been sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = DB::table('join_requests')
                    ->select('join_requests.*','users.name','projects.project_title')
                    ->join('users','join_requests.requester_id','=','users.id')
                    ->join('projects','join_requests.project_id','=','projects.id')
                    ->where('join_requests.id',$id)
                    ->first();
        
        return view('request.show')->with('request',$request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = JoinRequest::find($id);
        $request->delete();
        return redirect('/dashboard')->with('success','Request has been removed');
    }
}
