<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Common;
use Illuminate\Http\Request;
use Session;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $t)
    {
        $page_title="Our Team";
        $teams=$t->where('is_deleted',0)->orderBy('id','DESC')->paginate(10);
        return view('admin.teams.index',compact('page_title','teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Team Member";
        return view('admin.teams.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Team $t,Common $common)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'designation' => 'required|max:50',
            'description' => 'required|max:255',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048']
        ]);
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='teams');
            $data['image'] = $image;
        }
        $t->create($data);

        return redirect('/admin/teams')->with('message','Team Member Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $page_title="Edit Team Member";
        return view('admin.teams.create',compact('page_title','team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team,Common $common)
    {
        
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='teams');
            $data['image'] = $image;
            if(!empty($team->image) && $team->image!="NULL" ){
            $delete_prev_image = $common->delete_image($team->image,$folder='teams'); 
            }
        }
        $team->update($data);
        return redirect('/admin/teams')->with('message','Team Member Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team,Common $common)
    {
        if(!empty($team->image) && $team->image!=null)
        {
        $delete_prev_image = $common->delete_image($team->image,$folder='sliders');
        }
        if($team->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
