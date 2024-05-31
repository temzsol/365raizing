<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Faq $f)
    {
        $page_title="All Faq";
        $datas=$f->orderBy('id','DESC')->paginate(10);
        return view('admin.faqs.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Faq";
        return view('admin.faqs.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Faq $faq)
    {
        // Faq data section
        if(!empty($request->question))
        {
            $faq_data=$request->only(['question','answer','status']);
            foreach($faq_data['question'] as $key=>$value)
            {
                $faqd =array();
                $faqd['answer']=isset($faq_data['answer'][$key]) ? $faq_data['answer'][$key] : '';
                $faqd['question']=$value;
                $faq->create($faqd);
            }
        }
        return redirect('/admin/faqs')->with('message','Faqs Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $page_title="Edit Faq";
        return view('admin.faqs.update',compact('page_title','faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $data=$request->all();
        $faq->update($data);
        return redirect('/admin/faqs')->with('message','Faq Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        if($faq->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
