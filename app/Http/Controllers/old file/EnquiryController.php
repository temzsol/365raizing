<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Career;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Mail;
class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Enquiry $e)
    {
        $page_title="All Enquiry";
        $data=$e->where('status',1)->orderBy('id','DESC')->paginate(10);
        return view('admin.enquirys.contact',compact('page_title','data'));
    }

    public function career(Career $c)
    {
        $page_title="All Career Enwuiry";
        $data=$c->orderBy('id','DESC')->paginate(10);
        return view('admin.enquirys.career',compact('page_title','data'));
    }

    public function subscriber(Subscriber $s,Enquiry $e)
    {
        $page_title="All Subscriber";
        $subscriber = $s->where('status', 1)->orderBy('id', 'DESC')->get()->toArray();
        $enquiry=$e->where('status',1)->get()->toArray();
        $data=array_merge($subscriber,$enquiry);
             
        // $data=$s->where('status',1)->orderBy('id','DESC')->paginate(10);
        return view('admin.enquirys.subscriber',compact('page_title','data'));
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
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        if($enquiry->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
    public function career_delete($id,Career $c)
    {
        $data=Career::find($id);
        $data->delete();
        return redirect('admin/career')->with('message','Data is Deleted');
    }

public function subscriber_delete($id)
{
    // Find the subscriber by ID
    $subscriber = Subscriber::find($id);

    // Check if the subscriber actually exists
    if (!$subscriber) {
        return redirect('admin/subscribers')->with('error', 'Subscriber not found.');
    }

    // Delete the subscriber and check if the deletion was successful
    try {
        $subscriber->delete();
        return redirect('admin/subscribers')->with('message', 'Subscriber successfully deleted.');
    } catch (\Exception $e) {
        // If there's any exception, redirect with an error message
        return redirect('admin/subscribers')->with('error', 'Error deleting subscriber.');
    }
}


    


    
}
