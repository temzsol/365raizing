<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Common;
use DB;
class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Portfolio $p)
    {
        $page_title="All Portfolio";
        $datas=$p->orderBy('id','DESC')->paginate(10);
        return view('admin.portfolios.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Portfolio";
        $languages =Language::where('status',1)->get();
        return view('admin.portfolios.create',compact('page_title','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Portfolio $p,Common $common)
    {
        $validated = $request->validate([
            'project_name' => 'required|max:255',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,webp','max:5120']
        ]);
        $data=$request->all();
        if(empty($request->slug))
        {
            $data['slug']=$common->slugCreate($request->project_name);
        }
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='portfolios');
            $data['image'] = $image;
        }
          if ($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $image = $common->upload_single_image($file,$folder='portfolios');
            $data['banner_image'] = $image;
        }
        
        $data['language_id']=implode('|',$request->language_id);
        $p->create($data);
        return redirect('/admin/portfolios')->with('message','Portfolios Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $page_title="Edit portfolios";
       $languages =Language::where('status',1)->get();
        return view('admin.portfolios.create',compact('page_title','portfolio','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio,Common $common)
    {
        $data=$request->all();
        if(empty($request->slug))
        {
            $data['slug']=$common->slugCreate($request->project_name);
        }
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='portfolios');
            $data['image'] = $image;
            if(!empty($portfolio->image) && $portfolio->image!="NULL" ){
            $delete_prev_image = $common->delete_image($portfolio->image,$folder='portfolios'); 
            }
        }
        if ($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $image = $common->upload_single_image($file,$folder='portfolios');
            $data['banner_image'] = $image;
            if(!empty($portfolio->banner_image) && $portfolio->banner_image!="NULL" ){
            $delete_prev_image = $common->delete_image($portfolio->banner_image,$folder='portfolios'); 
            }
        }
        $data['language_id']=implode('|',$request->language_id);
        $portfolio->update($data);
        return redirect('/admin/portfolios')->with('message','Portfolios Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio,Common $common)
    {
        
         {

        if(!empty($portfolio->image) && $portfolio->image!=null)
        {
        $delete_prev_image = $common->delete_image($portfolio->image,$folder='portfolios');
        }
        if($portfolio->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
    

    }
}
