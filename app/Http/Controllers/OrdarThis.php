<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrdarThis extends Controller
{
    // order This Auth
    public function orderThisAuth(){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        $productId = $_GET['productId'];
        $productQuantity = $_GET['productQuantity'];
        $product = DB::table('products')
        ->select('name','currentPrice','image_1',)
        ->where(['id'=>$productId])
        ->get();
        $totalPrice = $product[0]->currentPrice *  $productQuantity;
        $productName = $product[0]->name;
        $productImage = $product[0]->image_1;
        $productPrice = $product[0]->currentPrice;
       
    

       
        return view('order-this-auth',['services'=>$services,'productName'=>$productName,'totalPrice'=>$totalPrice,'productQuantity'=>$productQuantity,"productImage"=>$productImage,"productPrice"=>$productPrice,"productId"=>$productId]);
    }
    // Place Order Auth
    public function placeOrderThisAuth(Request $req){
        $productName = $req->productName;
        $productImage = $req->productImage;
        $productPrice = $req->productPrice;
        $productTotalPrice = $req->productTotalPrice;
        $productQuantity = $req->productQuantity;
        $productId = $req->productId;
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
        ->insert(['productName'=>$productName,"productImage"=>$productImage,"productPrice"=>$productPrice,"productTotalPrice"=>$productTotalPrice,"productQuantity"=>$productQuantity,"userEmail"=>$userEmail,"productId"=>$productId,"orderStatus"=>'Active',"orderId"=>$lastOrder]);
        
    return back()->with('order-placed',"Order Placed Successfully");
    }
      // order This Guest
      public function orderThisGuest(){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        $productId = $_GET['productId'];
        $productQuantity = $_GET['productQuantity'];
        $product = DB::table('products')
        ->select('name','currentPrice','image_1',)
        ->where(['id'=>$productId])
        ->get();
        $totalPrice = $product[0]->currentPrice *  $productQuantity;
        $productName = $product[0]->name;
        $productImage = $product[0]->image_1;
        $productPrice = $product[0]->currentPrice;
       
    

       
        return view('order-this-guest',['services'=>$services,'productName'=>$productName,'totalPrice'=>$totalPrice,'productQuantity'=>$productQuantity,"productImage"=>$productImage,"productPrice"=>$productPrice,"productId"=>$productId]);
    }
     // Place Order Guest
     public function placeOrderThisGuest(Request $req){
        $productName = $req->productName;
        $productImage = $req->productImage;
        $productPrice = $req->productPrice;
        $productTotalPrice = $req->productTotalPrice;
        $productQuantity = $req->productQuantity;
        $productId = $req->productId;
        $userName = $req->userName;
        if(session()->has('email')){
            $userEmail = session()->get('email');
        }
        else{
            $userEmail = 'Guest';
        }
        
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
        ->insert(['productName'=>$productName,"productImage"=>$productImage,"productPrice"=>$productPrice,"productTotalPrice"=>$productTotalPrice,"productQuantity"=>$productQuantity,"userEmail"=>$userEmail,"productId"=>$productId,"orderStatus"=>'Active',"orderId"=>$lastOrder]);
        
    return back()->with('order-placed',"Order Placed Successfully");
    }
}
