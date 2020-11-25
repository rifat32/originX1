<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class AdminSide extends Controller
{
    public function index(){
        if(session()->has('adminLoggedIn')){
            return redirect('admin-panel');
        }
        else{
            return view('admin.admin-login');
        }
   
    }


    public function adminCheck(Request $req){
       
            $username = $req->input('username');
            $password = $req->input('password');
            if($username == 'masterRifat' && $password == 'abcd'){
                session()->put('adminLoggedIn', 'true');
    return redirect('admin-panel');
            }
            else{
            return back()->with('sorry', 'please insert valid information');
            }
        
      
        }


        public function adminPanelValidate(){
            if(session()->has('adminLoggedIn')){
                $services = Service::all()->sortBy("service");
                return view('admin.admin-panel',["services"=>$services]);
            }
            else{
                return redirect('admin-login');
            }
      }
      public function adminLogout(){
       session()->pull('adminLoggedIn');
            return redirect('admin-login');
        
  }

  
}
