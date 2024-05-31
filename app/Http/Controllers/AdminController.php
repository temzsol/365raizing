<?php

namespace App\Http\Controllers;
use App\Models\User;
use Redirect;
use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        if(Auth::check())
        {
            return redirect(route('master-dashboard'));
        }
        else
        {
            return view('admin.login');
        }
    }
    public function AuthLogin(Request $request){
        
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|min:8',
            'type'=>'required'
        ]);
        
        $credentials = $request->only('email', 'password');
        $credentials['type'] = $request->input('type');
        $credentials['status'] = 1;
        
        if(Auth::attempt($credentials))
        {
            $request->session()->put('type',Auth::user()->type);
            if(Auth::user()->type=='master_admin')
            {
                return redirect(route('master-dashboard'));
            }
            if(Auth::user()->type=='admin')
            {
                return redirect(route('admin_dashboard'));
            }
           
            if(Auth::user()->type=='hr')
            {
                return redirect(route('hr_dashboard'));
            }
            if(Auth::user()->type=='emp')
            {
                return redirect(route('mentor_dashboard'));
            }
            
        }
        else {
            return redirect()->back()->withInput($request->only('email', 'type'))->withErrors([
                'password' => 'Invalid email or password.',
            ]);
        }
    }
    
    
    
    

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->pull('result');
        return redirect('/login');
      }


    



}

