<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Carts;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function shoppingCart(){
        session()->pull('link');
        $services = Service::all()->sortBy("service");
        return view('shopping-cart',["services"=>$services]);
    }
    // All Cart Ajax Data
    public function cartAjaxDataAll(){
$data = DB::table('carts')
        ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])->get();
        return response()->json($data);
        
    }
    public function cartAjaxTotalPriceAll(){
        $data = DB::table('carts')
                ->select('productTotalPrice')
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
                    ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
                    ->get();
                   
                }
                else{
                    
                         DB::table('persons_total_carts')
                        ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
                        ->update(["total"=>$total]);
                        $personCart =  DB::table('persons_total_carts')
                        ->select('total')
                        ->where(["orderStatus"=> 'inCart',"userEmail"=>session()->get('email')])
                        ->get();
                       
                    }
                
                
               
               
                return response()->json($personCart);
                
            }
     // Delete Cart Ajax Data
    public function cartAjaxDataDelete($id){
        $data = DB::table('carts')
        ->where(["id"=> $id])
        ->delete();
        return response()->json($data);
        
    }
    // Add to cart on product page
    public function addCart(Request $req){
        // return $req->session()->get('email');
       $userEmail =  $req->session()->get('email');
       $orderStatus = $req->orderStatus;
       $orderId = $req->orderId;
       $productId = $req->productId;
        $productImage = $req->productImage;
        $productName = $req->productName;
        $productPrice = $req->productPrice;
        $productQuantity = $req->productQuantity;
        $productTotalPrice =   $productPrice * $productQuantity;
        $Cart = new Carts(); 
        $Cart->productId = $productId;
        $Cart->productImage = $productImage;
        $Cart->productName = $productName;
        $Cart->productPrice = $productPrice;
        $Cart->productTotalPrice = $productTotalPrice;
        $Cart->productQuantity = $productQuantity;
        $Cart->userEmail = $userEmail;
        $Cart->orderStatus = $orderStatus;
        $Cart->orderId = $orderId;
        $Cart->save();
           return back()->with('cart-added', 'This product is added to your cart' );
    }
}
