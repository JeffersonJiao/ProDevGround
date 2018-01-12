<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Project;
use App\Team;
use App\JoinRequest;
use App\File;
use DB;
use Image;
class FilesController extends Controller
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
    public function create()
    {
        //
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
            'file_image' => 'required|max:10000|mimes:png,jpg,jpeg,gif'
        ]);
        $file = new File;
        if($request->hasFile('file_image')){
            $image = $request->file('file_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $location = public_path('images/uploads/'. $filename);
            Image::make($image)->save($location);
            
        }
        $project_id = $request->input('project_id');
        $uploader_id = $request->input('uploader_id');
        $title = $request->input('title');
        $file->project_id = $project_id;
        $file->uploader_id = $uploader_id;
        $file->title = $title;
        $file->name = $filename;
        $file->save();
        return redirect('teams/'. $project_id)->with('success','File upload successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()){
            $user_id = auth()->user()->id;
            $file = DB::table('files')
                        ->join('users','users.id','=','files.uploader_id')
                        ->select('files.*','users.name as uploader_name')
                        ->where('files.id','=',$id)->first();
            // return $file;
            $project_id = $file->project_id;
            $found = Team::where('project_id','=',$project_id)
                            ->where('user_id',"=",$user_id)->get();
            if(count($found)>0){
                return view('files.show')->with('file',$file);
            }
            else{
                return redirect('dashboard/')->with('error','Unauthorized Page');
            }
        }
        else{
            return redirect('projects/')->with('error','Unauthorized Page');
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
        $file = File::find($id);
        

        if(auth()->user()->id !== $file->uploader_id){
            return redirect('/teams/'.$file->project_id)->with('error','Unauthorized Page');
        }
        $file->delete();
        return redirect('/teams/'.$file->project_id)->with('success','File Deleted');
    }
}
