<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $f)
    {
        $page_title="All Category";
        $datas=$f->orderBy('id','DESC')->paginate(10);
        return view('admin.categories.index',compact('page_title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title="Add Category";
        $category=Category::where('status',1)->get();
        return view('admin.categories.create',compact('page_title','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Category $category)
    {
        // Category data section
        if(!empty($request->name))
        {
            $category_data=$request->only(['name','image','slug','image_code','parent_category','status']);
            foreach($category_data['name'] as $key=>$value)
            {
                $categoryd =array();
                if (isset($category_data['image'][$key])){
                    $file = $category_data['image'][$key];
                    // dd($file);
                    $image = $this->upload_single_image($file,$folder='categories');
                    $categoryd['image'] = $image;
                }
                $categoryd['name']=$value;
                if(empty($category_data['slug'][$key]))
                {
                    $categoryd['slug']=$this->slugCreate($value);
                }
                else{
                    $categoryd['slug']=$category_data['slug'][$key];
                } 
                $categoryd['image_code']=$category_data['image_code'][$key];
                $category->create($categoryd);
            }
        }
        return redirect('/admin/categories')->with('message','Categorys Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $page_title="Edit Category";
        $pcategory=Category::where('status',1)->get();
        return view('admin.categories.update',compact('page_title','category','pcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data=$request->all();
        if(empty($request->slug))
                {
                    $data['slug']=$this->slugCreate($request->name);
                }
                else{
                    $data['slug']=$request->slug;
                } 
        $category->update($data);
        return redirect('/admin/categories')->with('message','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete())
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
