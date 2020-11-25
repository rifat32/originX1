<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\ContactMessage;

class SimplePagesController extends Controller
{
    // contact Page @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    public function contact(){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        return view('contact',["services"=>$services]);
    }
    // Contact Message @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    public function contactMessage(Request $request){
       $userName = $request->userName;
       $userEmail = $request->userEmail;
       $userMessage = $request->userMessage;

$message = new ContactMessage();
$message->userName = $userName;
$message->userEmail = $userEmail;
$message->userMessage = $userMessage;
$message->save();

        return back()->with('message-sent', 'Your Message has been sent successfully!');
    }

    public function faq(){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        return view('faq',["services"=>$services]);
    }
    public function activeOrders(){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        $datas = DB::table('carts')
        ->where(["orderStatus"=> 'active',"userEmail"=>session()->get('email')])
        ->orderByDesc('id')
        ->get();
        
        return view('active-orders',["services"=>$services,"datas"=>$datas]);
    }
    public function search(Request $req){
        $tagSearch = $req->search;
        $tagArray = explode(" ",$tagSearch);
        $products = DB::table('products')
        ->Where(function ($query) use($tagArray) {
            for ($i = 0; $i < count($tagArray); $i++){
               $query->orwhere('tags', 'like',  '%' . $tagArray[$i] .'%');
            } }
            )
        ->get();
        if(count($products) !== 0){
            $service = $products[0]->service;
            return redirect('/products' . '/' . $service . '/All?tag=' . $tagSearch  );
        }
        else{
            return back()->with('nothing-found','No product found . try with different keyword');
        }
    }
}
