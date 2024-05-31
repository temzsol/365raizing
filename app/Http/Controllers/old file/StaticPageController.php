<?php

namespace App\Http\Controllers;

use App\Models\Static_page;
use App\Models\Common;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Static_page $c)
    {
        $page_title="All Static Conent";
        $datas=$c->orderBy('id','DESC')->paginate(10);
        return view('admin.contents.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Contents";
        return view('admin.contents.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Common $common,Static_page $s)
    {
        $validated = $request->validate([
            'page_name' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='pages');
            $data['image'] = $image;
        }
        $s->create($data);

        return redirect('/admin/contents')->with('message','Content Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Static_page  $static_page
     * @return \Illuminate\Http\Response
     */
    public function show(Static_page $static_page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Static_page  $static_page
     * @return \Illuminate\Http\Response
     */
    public function edit(Static_page $static_page,$id)
    {
        $contents=Static_page::find($id);
        $page_title="Edit Slider";
        return view('admin.contents.create',compact('page_title','contents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Static_page  $static_page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Static_page $static_page,Common $common,$id)
    {
        $data=Static_page::find($id);
        $data['page_name']=$request->page_name;
        $data['title']=$request->title;
        $data['short_description']=$request->short_description;
        $data['long_description']=$request->long_description;
        $data['image_alt_name']=$request->image_alt_name;
        $data['status']=$request->status;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='pages');
            $data['image'] = $image;
            if(!empty($static_page->image) && $static_page->image!="NULL" ){
            $delete_prev_image = $common->delete_image($static_page->image,$folder='pages'); 
            }
        }
        $data->save();
        return redirect('/admin/contents')->with('message','Contents Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Static_page  $static_page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Static_page $static_page)
    {
        if(!empty($blog->image) && $blog->image!=null)
        {
        $delete_prev_image = $common->delete_image($blog->image,$folder='portfolios');
        }
        $blog->delete();
    }
}
