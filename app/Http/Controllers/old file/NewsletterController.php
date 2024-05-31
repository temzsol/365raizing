<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Models\Common;
use Mail;
use App\Models\Subscriber;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Newsletter $n)
    {
        $page_title="All Newsletters";
        $datas=$n->orderBy('id','DESC')->paginate(10);

        return view('admin.newsletters.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Newsletters";
return view('admin.newsletters.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Common $common,Newsletter $n)
    {
        $validated = $request->validate([
            'name' => 'required',
            'subject' => 'required|max:50',
            
        ]);
        $data=$request->all();
        $n->create($data);
        return redirect('/admin/newsletters')->with('message','Newsletter Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        $page_title="Edit Newsletter";
        return view('admin.newsletters.create',compact('page_title','newsletter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter,Common $common)
    {
        $data=$request->all();
        $newsletter->update($data);
        return redirect('/admin/newsletters')->with('message','Newsletter Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect('/admin/newsletters')->with('message','Newsletter Deleted Successfully');
    }

    public function sendmail(Request $request){
        $data = array();
        $data['newsletter']=Newsletter::find($request->id);
        $subscriber = Subscriber::where('status',1)->get()->toArray();

        
        if((!empty($data['newsletter'])) && ($data['newsletter']->id==$request->id))
        {
            $emailarray = array_column($subscriber,'email');
            foreach($emailarray as $v)
            {
                $data['email'] = $v;
                Mail::to($v)->send(new \App\Mail\Newsletter($data));
            }
            
        }
        else{
            return redirect('/admin/subscribers')->with('message','Sorry Newsletter Id Not Valid');
        }

    }
}
