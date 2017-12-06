<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $requests = DB::table('join_requests')
                    ->join('users','users.id', '=','join_requests.requester_id')
                    ->join('projects','projects.id', '=','join_requests.project_id')
                    ->where('join_requests.creator_id','=', $user_id)
                    ->select('join_requests.*','users.name','projects.project_title')
            
                    ->paginate(10, ['*'], 'requests');
        
        // $user = User::find($user_id);
        $projects = DB::table('projects')->where('user_id', '=', $user_id)->paginate(10, ['*'], 'projects');;
        // return $requests;
        return view('dashboard')->with('projects',$projects)->with('requests',$requests);

    }
    
    
}
