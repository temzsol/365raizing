<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\Common;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Testimonial $t)
    {
        $page_title="All Testimonial";
        $testimonial=$t->orderBy('id','DESC')->paginate(10);
        return view('admin.testimonials.index',compact('page_title','testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Testimonial";
        return view('admin.testimonials.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Common $common,Testimonial $t)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'star' => 'required'
        ]);
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='testimonials');
            $data['image'] = $image;
        }
        $t->create($data);

        return redirect('/admin/testimonials')->with('message','Ttestimonial Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $page_title="Edit Testimonial";
        return view('admin.testimonials.create',compact('page_title','testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial,Common $common)
    {
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='testimonials');
            $data['image'] = $image;
            if(!empty($testimonial->image) && $testimonial->image!="NULL" ){
            $delete_prev_image = $common->delete_image($testimonial->image); 
            }
        }
        $testimonial->update($data);
        return redirect('/admin/testimonials')->with('message','Testimonial Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial,Common $common)
    {
        if(!empty($testimonial->image) && $testimonial->image!=null)
        {
        $delete_prev_image = $common->delete_image($testimonial->image,$folder='testimonials');
        }
        if($testimonial->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
    
}
