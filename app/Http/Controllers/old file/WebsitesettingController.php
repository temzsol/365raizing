<?php

namespace App\Http\Controllers;

use App\Models\Websitesetting;
use Illuminate\Http\Request;
use App\Models\Common;

class WebsitesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Websitesetting $w)
    {
        $page_title="Website Setting";
        $datas =$w->where('is_deleted',0)->orderBy('id','DESC')->paginate(10);
        return view('admin.settings.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Website Setting";
        return view('admin.settings.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Websitesetting $w,Common $common)
    {
        $validated = $request->validate([
            'web_name' => 'required|max:50',
            'web_url' => 'required|max:50',
            'web_mobile' => 'required|max:50',
            'web_email' => 'required|max:100',
            'web_logo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);
        $data=$request->all();
        //dd($data);
        $data['web_social_tink_title']= implode(',',$request->web_social_tink_title);
        $data['web_social_link']= implode(',',$request->web_social_link);
        $data['web_mobile']= implode(',',$request->web_mobile);
        $data['web_phone']= implode(',',$request->web_phone);
        $data['web_email']= implode(',',$request->web_email);
        $data['web_google_map']= implode(',',$request->web_google_map);
        $data['address']= implode(',',$request->address);
        if ($request->hasFile('web_logo')){
            $file = $request->file('web_logo');
            $image = $common->upload_single_image($file,$folder='settings');
            $data['web_logo'] = $image;
        }
        $w->create($data);

        return redirect('/admin/settings')->with('message','Setting Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Websitesetting  $websitesetting
     * @return \Illuminate\Http\Response
     */
    public function show(Websitesetting $websitesetting)
    {
        $page_title="Website Setting";
        return view('admin.settings.create',compact('page_title','websitesetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Websitesetting  $websitesetting
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Websitesetting $websitesetting)
    {
        $page_title="Website Setting";
        $data=Websitesetting::find($id);
        $data['web_google_map']=$email=explode(',',$data['web_google_map']);
        $data['web_social_tink_title']=$email=explode(',',$data['web_social_tink_title']);
        $data['web_social_link']=$email=explode(',',$data['web_social_link']);
        $data['web_phone']=$email=explode(',',$data['web_phone']);
        $data['address']=$email=explode(',',$data['address']);
        $data['web_mobile']=$email=explode(',',$data['web_mobile']);
        $data['web_email']=$email=explode(',',$data['web_email']);
        
        return view('admin.settings.create',compact('page_title','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Websitesetting  $websitesetting
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Websitesetting $websitesetting,Common $common)
    {
        $data=Websitesetting::find($id);
        $dataw=$request->except('_method','_token');
        //dd($dataw);
        $dataw['web_social_tink_title']= implode(',',$request->web_social_tink_title);
        $dataw['web_social_link']= implode(',',$request->web_social_link);
        $dataw['web_mobile']= implode(',',$request->web_mobile);
        $dataw['web_phone']= implode(',',$request->web_phone);
        $dataw['web_email']= implode(',',$request->web_email);
        $dataw['web_google_map']= implode(',',$request->web_google_map);
        $dataw['address']= implode(',',$request->address);
        if ($request->hasFile('web_logo')){
            $file = $request->file('web_logo');
            $image = $common->upload_single_image($file,$folder='settings');
            $dataw['web_logo'] = $image;
        }

        // $this->setEnvironmentValue(array('MAIL_MAILER'=>$request->mail_mailer,'MAIL_HOST'=>$request->mail_host,'MAIL_PORT'=>$request->mail_port,'MAIL_USERNAME'=>$request->mail_username,'MAIL_PASSWORD'=>$request->mail_password,'MAIL_ENCRYPTION'=>$request->mail_enctype,'MAIL_FROM_ADDRESS'=>$request->mail_from_address));
        $data->update($dataw);
        return redirect('/admin/settings')->with('message','Setting Updated Successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Websitesetting  $websitesetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Websitesetting $websitesetting)
    {
        $data=Websitesetting::find($id);
        if($data->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
