<?php

namespace App\Http\Controllers;

use App\Models\Blogcomment;
use Illuminate\Http\Request;

class BlogcommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($_GET['blog_id'])
        {
            $page_title="Blog Comments";
            $datas=Blogcomment::leftJoin('blogs', 'blogs.id', '=', 'blogcomments.blog_id')
            ->select('blogcomments.*','blogs.title')
            ->orderBy('blogcomments.id','DESC')->paginate(10);
            // $datas=Blogcomment::where('id',$_GET['blog_id'])->paginate(10);
            return view('admin.blogs.comments',compact('page_title','datas'));
        }
        else
        {
            return back();
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogcomment  $blogcomment
     * @return \Illuminate\Http\Response
     */
    public function show(Blogcomment $blogcomment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogcomment  $blogcomment
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogcomment $blogcomment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogcomment  $blogcomment
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Blogcomment $blogcomment)
    {
        $data=Blogcomment::find($id);
       $data['answer']=$request->answer;
       $data['status']=1;
       $data['read_status']=1;
       $data->save();
       return back()->with('message','Comment Reply is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogcomment  $blogcomment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Blogcomment $blogcomment)
    {
        $data=Blogcomment::find($id);
        $data->delete();
        return back()->with('message','Comment is Deleted');
    }
}
