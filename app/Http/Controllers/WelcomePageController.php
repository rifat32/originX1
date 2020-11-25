<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class WelcomePageController extends Controller
{
    public function welcome(Request $req){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        
                             
       
            $products = DB::table('products')
            ->orderByDesc('ids')
            ->paginate(8);
                     
       
        
                 if($req->ajax()){
                    $view = view('infiniteProducts',compact('products'))->render();
                    return response()->json(['html'=>$view]);
                }
        return view('welcome',["services"=>$services,'products'=>$products]);
    }
    
}
