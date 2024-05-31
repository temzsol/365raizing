<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Websitesetting;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Newsletter;
use App\Models\Static_page;
use App\Models\Subscriber;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Blogcomment;
use Mail;
use DB;
use Validator;
use Session;

class HomeController extends Controller
{
    public function index(){
       $portfolio= Portfolio::where('fetured',1)->where('status',1)->get();
       $slider= Slider::where('status',1)->get();
       $page=Page::where('status',1)->where('fetured_service',1)->get();
       $services=Page::where('status',1)->get();
       $faq=Faq::where('status',1)->where('fetured',1)->get();
    //    dd($faq);
       $meta=array();
       $meta=['keywords'=>'CRM Software, Mobile Applications development, custom websites, responsive design, back-end development, website maintenance, website redesign, website optimization, CMS development, e-commerce development','description'=>'RR Web Development: A leading and best-in-class web development company, offering top budget-friendly solutions for growing businesses.'];
       $setting=Websitesetting::find(1);
       $blog = DB::table('categories')
        ->leftJoin('blogs', 'blogs.cat_id', '=', 'categories.id')->
        select('categories.name','categories.slug as cat_slug','blogs.*')->where('blogs.status',1)->orderBy('id','DESC')
            ->get();
        return view('front.home',compact('portfolio','page','meta','setting','slider','faq','blog','services'));
    }
    public function about(){
        $meta=array();
        $meta=['keywords'=>'Unlocking Success with the Leading IT Strategy & Software Consulting Services Company in Delhi, India. Our specialized solutions deliver rapid and highly effective responses to your business needs','description'=>'RR Web Development, we are a leading provider of comprehensive web solutions. With expertise in web development, SEO, graphic design, website design, and WordPress development'];
        $page=Page::where('status',1)->get();
         $portfolio= Portfolio::where('fetured',1)->where('status',1)->get();
        $setting=Websitesetting::find(1);
        return view('front.about',compact('meta','setting','page','portfolio'));
    }
    public function contact(){
        $meta=array();
        $meta=['keywords'=>'custom software development, web application development, web development services, technology solutions, graphic design , e-commerce website development for small businesses','Contact us today to learn more about how we can elevate your online presence with our expertise and services. Mob: +91 8920504677','description'=>'RR Web Development we are a leading provider of comprehensive web solutions. With expertise in web development, SEO, graphic design, website design, and WordPress development'];
        $setting=Websitesetting::find(1);
        return view('front.contact',compact('meta','setting'));
    }
    public function faq(){
        $meta=array();
        $faq=Faq::where('status',1)->get();
        $meta=['keywords'=>'RR web development company near Dwarka, RR web development in New Delhi ,RR web development in Najafgarh, RR web development near Uttam Nagar, RR web development near Nangoli, Vikash puri,Janak puri','description'=>'RR Web Development: Experts in web development, SEO, graphic design, website design, and WordPress development. Transform your online presence today!'];
        return view('front.faq',compact('faq','meta'));
    }
    public function project(){
        $meta=array();
        $all=Portfolio::where('status',1)->orderBy('id','DESC')->get();
        $wordpress=Portfolio::where('status',1)->where('categories','Wordpress')->orderBy('id','DESC')->get();
        $html=Portfolio::where('status',1)->where('categories','html')->orderBy('id','DESC')->get();
        $php=Portfolio::where('status',1)->where('categories','Php')->orderBy('id','DESC')->get();
        $laravel=Portfolio::where('status',1)->where('categories','Laravel')->orderBy('id','DESC')->get();
        
        $meta=['keywords'=>'Website for retailers , Website builder for school  , Website builder for hostipal  , Website builder for Automobile,  Website builder for All Small Busniss','description'=>'Discover top-notch web development services, custom software development, and graphic design solutions for your business. We specialize in web application development and e-commerce website development for small businesses. Experience innovative technology solutions tailored to your needs. Explore our services now !'];
        return view('front.project',compact('html','wordpress','html','laravel','php','meta','all'));
    }
    public function project_details($slug){
        $meta=array();
       
        $project=Portfolio::where('status',1)->where('slug',$slug)->first();
        $meta=['meta_title'=>$project->meta_title,'keywords'=>$project->meta_keywords,'description'=>$project->meta_description]; 
        $lang=explode('|',$project['language_id']);
        
        $languages=DB::table('languages')->whereIn('id', $lang)->get();
        return view('front.project_details',compact('project','meta','languages'));
    }
    //  for services page
    public function services(){
        $all=Portfolio::where('status',1)->get();
        $wordpress=Portfolio::where('status',1)->where('categories','Wordpress')->get();
        $html=Portfolio::where('status',1)->where('categories','html')->get();
        $php=Portfolio::where('status',1)->where('categories','Php')->get();
        $laravel=Portfolio::where('status',1)->where('categories','Laravel')->get();
        $meta=array();
        $meta=['keywords'=>'RR web development company near Dwarka, New Delhi ,Najafgarh, Uttam Nagar, Nangoli, Vikash puri,Janak puri','RR Web Development: Experts in web development, SEO, graphic design, website design, and WordPress development. Transform your online presence today!'];
        $page=Page::where('status',1)->get();
        return view('front.services',compact('page','meta','html','wordpress','html','laravel','php'));
    }
    public function category($slug){
        $meta=array();
        $meta=['keywords'=>'RR web development company near Dwarka, New Delhi ,Najafgarh, Uttam Nagar, Nangoli, Vikash puri,Janak puri','description'=>'RR Web Development: Experts in web development, SEO, graphic design, website design, and WordPress development. Transform your online presence today!'];
        $category = Category::where('status',1)->where('slug',$slug)->first();
        $page=Page::where('status',1)->where('cat_id',$category['id'])->get();
        return view('front.services',compact('page','meta'));
    }

    public function services_details($slug){
        $meta=array();
        $category = Category::where('status',1)->get();
        $service = DB::table('categories')
        ->where('pages.slug','=',$slug)
        ->leftJoin('pages', 'pages.cat_id', '=', 'categories.id')->
        select('categories.name','categories.slug as cat_slug','pages.*')
        ->first();
      
        $meta=['meta_title'=>$service->meta_title,'keywords'=>$service->meta_keywords,'description'=>$service->meta_description,'meta_image'=>url('/images/pages/'.$service->image)];
            if($service){
                return view('front.services-details',compact('service','category','meta'));
            }
            else{
                return back();
            }
        
    }
  

    
    //  for Blog Code
    public function blog(Request $request){
        $meta=array();
        $meta=['keywords'=>'RR web development company near Dwarka, New Delhi ,Najafgarh, Uttam Nagar, Nangoli, Vikash puri,Janak puri','description'=>'RR Web development refers to the process of building and maintaining websites. RR web development involves in variety of tasks such as designing, coding, and testing the website to ensure it functions properly.RR Website development services offer businesses and individuals the opportunity to have a professional and effective online presence.','meta_title'=>'Blogs'];
        $page=DB::table('categories')
        ->select('categories.*',DB::raw('(select count("blogs.cat_id") FROM blogs where categories.id=blogs.cat_id) as total_count'))->get();
        
        // $blog=Blog::where('title', 'LIKE', '%'.$request->search.'%')->orWhere('description', 'LIKE', '%'.$request->search.'%')->paginate(6);
        
        $setting=$this->setting();
        $recent=Blog::where('status',1)->orderBy('id','DESC')->take(5)->get();
        $tags=Tag::select('name')->distinct()->orderBy('id','DESC')->get();
        
        if(isset($_GET['categories']) && $_GET['categories'])
                {
                    $cat_id=Category::where('slug',$_GET['categories'])->first();
                    //   dd($cat_id->meta_title);
                    if(!empty($cat_id)  && $cat_id!=null)
                    {
                        $blog=Blog::where('cat_id', $cat_id['id'])->orderBy('id','DESC')->paginate(6);
                        $meta=['keywords'=>$cat_id->meta_keywords,'description'=>$cat_id->meta_description,'meta_title'=>$cat_id->meta_title];

                    }
                    else
                    {
                        return back()->with('message','No Blog Found Categories Related');
                    }
                }
                
        
        elseif(isset($_GET['tags']) && $_GET['tags'])
        {
            $blog=Blog::where('title', 'LIKE', '%'.$_GET['tags'].'%')->orWhere('description', 'LIKE', '%'.$_GET['tags'].'%')->orderBy('id','DESC')->paginate(6);
            if(count($blog)<0)
            {
                return back()->with('message','No Blog Found Tag Related');
            }
        }
        else{
            $blog=Blog::where('status',1)->orderBy('id','DESC')->paginate(6);
            }
        return view('front.blog-list',compact('page','blog','recent','setting','meta','tags'));
    }
    
    public function blog_search(Request $request){
        //   dd($request->all());
            $page=DB::table('categories')
        ->select('categories.*',DB::raw('(select count("blogs.cat_id") FROM blogs where categories.id=blogs.cat_id) as total_count'))->get();
            $recent=Blog::where('status',1)->orderBy('id','DESC')->take(5)->get();
            $tags=Tag::select('name')->distinct()->get();
            $blog=Blog::where('title', 'LIKE', '%'.$request->search.'%')->orWhere('description', 'LIKE', '%'.$request->search.'%')->paginate(10);
             $setting=$this->setting();
            if(count($blog)>0)
            {
                return view('front.blog-list',compact('blog','page','tags','recent','setting'));
            }
            else{
                return back()->with('message','No Blog Found');
            }
    }
    public function blog_details($slug){
        $meta=array();
        $post = Blog::where('slug','=',$slug)->first();
            $post->update([
            'total_view' => $post->total_view + 1
            ]);
            $comment_count=Blogcomment::where('blog_id',$post->id)->where('status',1)->count();
            $comments=Blogcomment::where('status',1)->get();
        $blog = DB::table('categories')
        ->where('blogs.slug','=',$slug)
        ->leftJoin('blogs', 'blogs.cat_id', '=', 'categories.id')->
        select('categories.name','categories.slug as cat_slug','blogs.*')
            ->first();
         $page=DB::table('categories')
            ->select('categories.*',DB::raw('(select count("blogs.cat_id") FROM blogs where categories.id=blogs.cat_id) as total_count'))->get();
        $meta=['meta_title'=>$blog->meta_title,'keywords'=>$blog->meta_keywords,'description'=>$blog->meta_description,'meta_image'=>url('/images/blogs/'.$blog->image)];  
        $tags=Tag::select('name')->distinct()->get();
        $recent=Blog::where('status',1)->orderBy('id','DESC')->take(5)->skip(0)->get();
        $category= Category::where('status',1)->get();
        $setting=$this->setting();
        return view('front.blog-details',compact('blog','category','recent','tags','setting','meta','page'));
    }

    //  for contact us page
    public function contactform(Request $request,Enquiry $e){
        // $validated = $request->validate([
        //     'name' => 'required|max:255',
        //     'phone' => 'required|max:10',
        //     'email' => 'email:rfc,dns',
        //     'message' => 'required',
        // ]);
        
        
    $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|max:10',
            'email' => 'email:rfc,dns',
            'message' => 'required',
            
  ]);

          if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
          }
        
      $fordata=array('name'=>$request->name,'phone'=>$request->phone,'email'=>$request->email,'message'=>$request->message,'subject'=>$request->subject);
      Session::put('data',$fordata);
    
      
      
             $secret_key = env('Secreat_key');
             $response = $request['g-recaptcha-response'];       
             $user_ip = $_SERVER['REMOTE_ADDR'];
             $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$user_ip";
             $fire = file_get_contents($url);
                $result=json_decode($fire);  
                
     if($result->success==true)
            { 
                    
                    
                    $data=$request->all();
                    $data['status']=1;
                    
                    $result=$e->create($data);
                    if($result)
                    {
                        Mail::to('contact@rrwebdevelopment.in')->send(new \App\Mail\MailContact($data));
                        Session::pull('data');
                       return redirect('/thank-you')->with('message','Successfully Send');
                    }
                    else
                    {
                    return redirect('/contact')->with('message','Something Went Wrong!');
                    }
            }
            else{
    
                    session()->flash('message','Please Fill Google Captcha');
                    return redirect('/contact/');
                }
        
      }
     
    
    public function blogCommentStore(Request $request,Blogcomment $bc){
         $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'email:rfc,dns',
            'comments' => 'required',
            'captch' => 'required',
        ]);
        
        if($request->first_value + $request->second_value == $request->captch)
      {
         $data=$request->all();
        $data['status']=0;
        $result=$bc->create($data);
        if($result)
        {
           return redirect('/thank-you')->with('message','Your Comment is under review of admin..');
        }
        else
        {
        return back()->with('message','Something Went Wrong!');
        }
      
    }
     else
      {
          return back()->with('message','Captch Not Match');
      }
    }

    public function subscribe(Request $request,Subscriber $s){
        // dd('dafds');
        $data=$request->all();
        $data['status']=1;
        $secret_key = env('Secreat_key');
             $response = $request['g-recaptcha-response'];       
             $user_ip = $_SERVER['REMOTE_ADDR'];
             $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$user_ip";
             $fire = file_get_contents($url);
            $result=json_decode($fire);  
            if($result->success==1)
            {
                    $s->create($data);
                    Mail::to($request->email)->send(new \App\Mail\MailSubscriber($data));
                    return redirect('/thank-you');

            }
            else
            {
                return back()->with('message','Captch is invalid!');
            }
        

    }
    public function terms(){
        return view('front.terms');
    }
    
    public function unsubscribe($email,Subscriber $s){
        $data=Subscriber::where('email','=',$email)->first();
       return view('front.unsubscribe',compact('data'));
        
    }
     public function unsubscribe_post(Request $request){
        $data=Subscriber::where('email','=',$request->email)->first();
        $data['status']=0;
        $data->update();
       return view('front.unsubscribe');
        
    }
        

    public function privacy(){
        return view('front.privacy');
    }
    public function thankyou(){
        return view('front.thankyou');
    }
}
