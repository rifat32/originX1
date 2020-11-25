<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CheckOutController extends Controller
{
    public function checkOut(){
       
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        $data = DB::table('carts')
                ->select('productName','productQuantity','productTotalPrice')
                ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])->get();
                
                $total = 0; 
                foreach($data as $datas){
$total += intval($datas->productTotalPrice);
                }
             
           $personCart =  DB::table('persons_total_carts')
                ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
                ->get();
                if(count($personCart) == 0){
                      DB::table('persons_total_carts')
                    ->insert(["total"=>$total,"orderStatus"=> 'inCart',"userEmail"=>session()->get('email')]);
                    $personCart =  DB::table('persons_total_carts')
                    ->select('total')
                    ->where(["orderStatus"=> 'inCart',"userEmail"=>session()
                    ->get('email')])
                    ->get();
                   
                }
                else{
                    
                        $personCart =  DB::table('persons_total_carts')
                        ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
                        ->update(["total"=>$total]);
                        $personCart =  DB::table('persons_total_carts')
                        ->select('total')
                        ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
                        ->get();
                       
                    }
                
                
      
        return view('check-out',["services"=>$services,"personCart"=>$personCart,"data"=>$data]);
    }
    // Place Order
    public function placeOrder(Request $req){
        
$userName = $req->userName;
$userEmail = session()->get('email');
$userAddress = $req->userAddress;
$userPhone = $req->userPhone;
$userMessage = $req->userMessage;
if(strlen($userMessage) == 0){
    $userMessage = 'empty';
}
$orderStatus = 'Active';
$order = new Order;
$order->userName = $userName;
$order->userEmail = $userEmail;
$order->userPhone = $userPhone;
$order->userAddress = $userAddress;
$order->userMessage = $userMessage;
$order->orderStatus = $orderStatus;
$order->save();
$lastOrder = $order->id;
       DB::table('carts')
    ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
    ->update(['orderStatus'=>'Active','orderId'=>$lastOrder]);
    
return back()->with('order-placed',"Order Placed Successfully");


    }
}
