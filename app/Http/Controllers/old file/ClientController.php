<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $f)
    {
        $page_title="All Client";
        $datas=$f->orderBy('id','DESC')->paginate(10);
        return view('admin.clients.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Client";
        return view('admin.clients.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Client $client)
    {
        // Client data section
        if(!empty($request->name))
        {
            $client_data=$request->only(['name','image']);
            foreach($client_data['name'] as $key=>$value)
            {
                $clientd =array();
                if (isset($client_data['image'][$key])){
                    $file = $client_data['image'][$key];
                    // dd($file);
                    $image = $this->upload_single_image($file,$folder='clients');
                    $clientd['image'] = $image;
                }
                $clientd['name']=$value;
                $client->create($clientd);
            }
        }
        return redirect('/admin/clients')->with('message','Clients Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $page_title="Edit Client";
        return view('admin.clients.update',compact('page_title','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $data=$request->all();
        $client->update($data);
        return redirect('/admin/clients')->with('message','Client Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
