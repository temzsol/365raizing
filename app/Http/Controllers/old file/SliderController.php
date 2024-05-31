<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Common;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Slider $s)
    {
        $page_title="All Sliders";
        $datas=$s->where('is_deleted',0)->orderBy('id','DESC')->paginate(10);
        return view('admin.sliders.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Slider";
        return view('admin.sliders.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Slider $s,Common $common)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            //'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='sliders');
            $data['image'] = $image;
        }
        if(empty($request->slug)){
            $data['slug']=$this->slugCreate($request->title);
        }
        $s->create($data);

        return redirect('/admin/sliders')->with('message','Slider Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $page_title="Edit Slider";
        return view('admin.sliders.create',compact('page_title','slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider,Common $common)
    {
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='sliders');
            $data['image'] = $image;
            if(!empty($slider->image) && $slider->image!="NULL" ){
            $delete_prev_image = $common->delete_image($slider->image,$folder='sliders'); 
            }
        }
        if(empty($request->slug)){
            $data['slug']=$this->slugCreate($request->title);
        }
        $slider->update($data);
        return redirect('/admin/sliders')->with('message','Sliders Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider,Common $common)
    {

        if(!empty($slider->image) && $slider->image!=null)
        {
        $delete_prev_image = $common->delete_image($slider->image,$folder='sliders');
        }
        if($slider->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
