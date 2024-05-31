<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Common;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Page $p)
    {
        $page_title="All Pages";
        $datas=$p->where('is_deleted',0)->orderBy('id','DESC')->paginate(10);
        return view('admin.pages.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Page";
        $category=Category::where('status',1)->get();
        return view('admin.pages.create',compact('page_title','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Common $common,Page $p,Faq $faq)
    {
        
        //print_r($request->all());die;
        $validated = $request->validate([
            'page_title' => 'required|max:20',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:51020']
        ]);
        
        $data=$request->except(['question','answer']);
        //dd($request->jtitle);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='pages');
            $data['image'] = $image;
        }
        if ($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $banner_image = $common->upload_single_image($file,$folder='banners');
            $data['banner_image'] = $banner_image;
        }
        if ($request->hasFile('image_short')){
            $file = $request->file('image_short');
            $image_short = $common->upload_single_image($file,$folder='pages');
            $data['image_short'] = $image_short;
        }
        if(empty($request->slug))
        {
            $data['slug']=$common->slugCreate($request->page_title);
        }
        
        $page_id=$p->create($data);

        // Cerical data section
        if(!empty($request->cdescription))
        {
            $cdata=$request->only(['question','answer']);
            foreach($cdata['question'] as $key=>$value)
            {
                $insert_faq = array();
                $insert_faq['question']=$value;
                $insert_faq['answer']=$value[$key]['answer'];
                $insert_faq['page_id']=$page_id['id'];
                $faq->create($insert_faq);
            }
        }
       

       

        //dd($page_id['id']);
        return redirect('/admin/pages')->with('message','page Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page,Faq $faq)
    {
        $page_title="Edit page";
        $faq_data=Faq::where('page_id',$page->id)->get();
        $category=Category::where('status',1)->get();
        return view('admin.pages.create',compact('page_title','page','faq_data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page,Common $common,Faq $faq)
    {
        
        $data=$request->except(['question','answer']);
        //dd($request->jtitle);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $common->upload_single_image($file,$folder='pages');
            $data['image'] = $image;
        }
        if ($request->hasFile('banner_image')){
            $file = $request->file('banner_image');
            $banner_image = $common->upload_single_image($file,$folder='banners');
            $data['banner_image'] = $banner_image;
        }
        if ($request->hasFile('image_short')){
            $file = $request->file('image_short');
            $image_short = $common->upload_single_image($file,$folder='pages');
            $data['image_short'] = $image_short;
        }
        
        if($request->slug ==null && $request->slug=='')
        {
            $data['slug']=$common->slugCreate($request->page_title);
        }
        // dd($data);
        $page->update($data);
        if(!empty($request->question))
        {
            if(count(Faq::where('page_id',$page->id)->get())>0)
            {
                Faq::where('page_id',$page->id)->delete();
            }
        }
        // Faq data section
        if(!empty($request->question))
        {
            $faq_data=$request->only(['question','answer']);
            foreach($faq_data['question'] as $key=>$value)
            {
                $faqd =array();
                $faqd['answer']=isset($faq_data['answer'][$key]) ? $faq_data['answer'][$key] : '';
                $faqd['question']=$value;
                $faqd['page_id']=$page->id;
                $faq->create($faqd);
            }
        }
        
        
        return redirect('/admin/pages')->with('message','Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page,Common $common,Faq $faq)
    {
       
        if(!empty($page->image) && $page->image!=null)
        {
        $delete_prev_image = $common->delete_image($page->image,$folder='pages');
        }
        if(!empty($page->banner_image) && $page->banner_image!=null)
        {
        $delete_prev_image = $common->delete_image($page->banner_image,$folder='banners');
        }
   
        Faq::where('page_id',$page->id)->delete();
        if($page->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
