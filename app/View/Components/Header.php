<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if(session()->has('email')){
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
                $carts = count($data);
        }
        else{
            $carts = "No Need";
            $personCart = "No Need";
        }
       
        
        return view('components.header',["carts"=>$carts,"personCart"=>$personCart]);
    }
}
