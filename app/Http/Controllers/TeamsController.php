<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Team;
use App\JoinRequest;
use DB;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $teams = DB::table('teams')
                        ->select('teams.project_id','projects.project_title','projects.user_id','users.name')
                        ->join('projects','projects.id','=','teams.project_id')
                        ->join('users','users.id','=','projects.user_id')
                        ->where('teams.user_id',$user_id)
                        ->paginate(5);
        return view('teams.index')->with('teams',$teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $team = new Team;
      $team->user_id = $request->input('requester_id');
      $team->project_id = $request->input('project_id');
      $request_id = $request->input('joinrequest_id');
      $request = JoinRequest::find($request_id);
      $request->delete();
      $team->save();
      return redirect('/dashboard')->with('success','You have welcomed a new member');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $members = DB::table('teams')
                        ->join('projects','teams.project_id','=','projects.id')
                        ->join('users','users.id','=','teams.user_id')
                        ->select('teams.*','projects.user_id as creator_id','users.name as member_name')
                        ->where('teams.project_id',$id)
                        ->get();
        return view('/teams.show')->with('members',$members);
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
        $member = Team::find($id);
        $member->delete();
        return redirect('teams')->with('success','Removing a team member/Leaving the team is successful');
    }
}
