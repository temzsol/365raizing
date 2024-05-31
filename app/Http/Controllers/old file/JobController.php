<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Common;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Job $j)
    {
        $page_title="All Job";
        $datas=$j->orderBy('id','DESC')->paginate(10);

        return view('admin.jobs.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Job";
return view('admin.jobs.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Common $common,Job $j)
    {
        $validated = $request->validate([
            'postion' => 'required',
            'profiledescription' => 'required',
            'experience' => 'required',
            'industry_type' => 'required',
            'vaccancy' => 'required',            
        ]);
        $data=$request->all();
        $j->create($data);
        return redirect('/admin/jobs')->with('message','Jobs Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $page_title="Edit Job";
        return view('admin.jobs.create',compact('page_title','job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $data=$request->all();
        $job->update($data);
        return redirect('/admin/jobs')->with('message','Job Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/admin/jobs')->with('message','Job Deleted Successfully');
    }
}
