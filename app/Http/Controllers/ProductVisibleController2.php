<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Service;
use App\Models\ProductCategory;
use App\Models\Carts;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

class ProductVisibleController2 extends Controller
{
    public function singleProduct($id){
      session()->pull('link');
      // Service @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
          $services = Service::all()->sortBy("service");
      //  Product @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
          $product = Product::where("id", $id)->get();
      //  Category @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        $productCategories = ProductCategory::where('service', $product[0]->service)
          ->orderBy('category', 'asc')
          ->get();
        // Brand  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
          $productBrands = DB::table('products')
          ->select('id','brand')
          ->where(['service'=>$product[0]->service,'category'=>$product[0]->category])
          ->orderBy('id', 'desc')
          ->get();
        // Global Tags @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ 
          $globalTags = DB::table('tags')
          ->select('tag')
          ->where('service', $product[0]->service)
          ->orderBy('tag', 'asc')
          ->get();
        // related Products @@@@@@@@@@@@@@@@@@@@@@@
        $relatedProducts = DB::table('products')
        ->where('category', $product[0]->category)
        ->where('id', '!=', $id)
        ->get();
        $finalRelatedProducts = array();
          $relatedProductsArray = json_decode(json_encode($relatedProducts), true);
          $listOfrelatedProducts = sizeof($relatedProducts);
          if($listOfrelatedProducts < 4 && $listOfrelatedProducts !== 0){
            foreach($relatedProductsArray as $relatedProductArray){
              array_push($finalRelatedProducts, $relatedProductArray);
            }
           
          }
         else if($listOfrelatedProducts >= 4){
            $relatedRandomKeys = array_rand($relatedProductsArray, 4);
        
            foreach($relatedRandomKeys as $relatedRandomKey){
              array_push($finalRelatedProducts, $relatedProductsArray[$relatedRandomKey]);
            }
           
      
          }
          else {
            array_push($finalRelatedProducts, -1);
          }
          // In  Cart Check
          if(session()->get('email') !== null){
            $cart = DB::table('carts')
            ->where(['userEmail'=> session()->get('email'),"productId"=>$id,"orderStatus"=>'inCart'])
            ->get();
          
            if(sizeof($cart) !== 0){
              $inCart = "yes";
            }
            else{
              $inCart = "no";
            }
          }
          else{
            $inCart = "no";
          }
          // Product  colors 
          if($product[0]->colors !== "-1"){
$colorsArray = explode(" ",$product[0]->colors);
          }
          else{
            $colorsArray = "-1";
          }
           // Product  Sizes
           if($product[0]->sizes !== "-1"){
            $sizesArray = explode(" ",$product[0]->sizes);
                      }
                      else{
                        $sizesArray = "-1";
                      }    
          
         

       
   
       
         
            return view('product', ["product"=>$product,"services"=>$services,"productCategories"=>$productCategories,"productBrands"=>$productBrands,"globalTags"=>$globalTags,"finalRelatedProducts"=>$finalRelatedProducts,"inCart"=>$inCart,"colorsArray"=>$colorsArray,"sizesArray"=>$sizesArray]);
           
          
        }
}
