<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    // View Active Orders
    public function viewActiveOrders(){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
            $orders = DB::table('orders')
                      ->where(['orderStatus'=>'Active'])
                      ->orderByDesc('id')
                      ->paginate(20);
            return view('admin.active-orders',["services"=>$services,"orders"=>$orders]);
        }
        else{
            return redirect('admin-login');
        }

    }
     // View completed Orders
     public function viewCompletedOrders(){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
            $orders = DB::table('orders')
                      ->where(['orderStatus'=>'Completed'])
                      ->orderByDesc('id')
                      ->paginate(20);
            return view('admin.completed-orders',["services"=>$services,"orders"=>$orders]);
        }
        else{
            return redirect('admin-login');
        }

    }
    // View Carts On Order
    public function viewOrder($id){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
            $carts = DB::table('carts')
                      ->where(['orderId'=>$id])
                      ->orderByDesc('id')
                      ->get();
             $total = 0;
             foreach($carts as $cart){
$total += intval($cart->productTotalPrice);
             }         
            return view('admin.active-order-cart',["services"=>$services,"carts"=>$carts,"total"=>$total]);
        }
        else{
            return redirect('admin-login');
        }
    }
    // Delete Cart
    public function deleteCart($id){
        if(session()->has('adminLoggedIn')){
            DB::table('carts')
        ->where(['id'=>$id])
        ->delete();
        return back()->with('cart-deleted','Cart has been deleted successfully');
        }
        else{
            return redirect('admin-login');
        }
    }
    // Complete Order
    public function completeOrder($id){
        if(session()->has('adminLoggedIn')){
            DB::table('orders')
        ->where(['id'=>$id])
        ->update(['orderStatus'=>'Completed']);
        DB::table('carts')
                      ->where(['orderId'=>$id])
                      ->update(['orderStatus'=>'Completed']);
        return back()->with('order-completed','Order has been completed successfully');
        }
        else{
            return redirect('admin-login');
        }
    }
    // Cancel Order
    public function cancelOrder($id){
        if(session()->has('adminLoggedIn')){
            DB::table('orders')
        ->where(['id'=>$id])
        ->update(['orderStatus'=>'Canceled']);
        DB::table('carts')
        ->where(['orderId'=>$id])
        ->update(['orderStatus'=>'Canceled']);
        return back()->with('order-canceled','Order has been canceled successfully');
        }
        else{
            return redirect('admin-login');
        }
    }
}






