<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Common;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Blog $b)
    {
        $page_title="All Blog";
        $datas=$b->orderBy('id','DESC')->paginate(10);
        return view('admin.blogs.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Blog";
        $cat=Category::where('status',1)->get();
        return view('admin.blogs.create',compact('page_title','cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Common $common,Blog $b,Tag $tags)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,webp','max:2048']
        ]);
        $data=$request->all();
        $data['tags']=implode("|",$request->tags);
        if(empty($request->slug))
        {
            $data['slug']=$common->slugCreate($request->title);
        }
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='blogs');
            $data['image'] = $image;
        }
        $blog_id=$b->create($data);
        $tag_data=$request->only(['tags']);
        foreach($tag_data['tags'] as $key=>$value)
        {
            $cir = array();
            $cir['name']=$value;
            $cir['blog_id']=$blog_id['id'];
            $tags->create($cir);
        }
        return redirect('/admin/blogs')->with('message','Blog Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $page_title="Edit blog";
        $cat=Category::where('status',1)->get();
        $tags=Tag::where('blog_id',$blog->id)->get();
        return view('admin.blogs.create',compact('page_title','blog','cat','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog,Tag $tags,Common $common)
    {
        $data=$request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='blogs');
            $data['image'] = $image;
            if(!empty($blog->image) && $blog->image!="NULL" ){
            $delete_prev_image = $common->delete_image($blog->image,$folder='blogs'); 
            }
        }
        $data['tags']=implode("|",$request->tags);
        $blog->update($data);
        
        return redirect('/admin/blogs')->with('message','blogs Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog,Common $common)
    {
        if(!empty($blog->image) && $blog->image!=null)
        {
        $delete_prev_image = $common->delete_image($blog->image,$folder='blogs');
        }
        if($blog->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
