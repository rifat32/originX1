<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory;
use App\Models\Service;

class ProductVisibleController extends Controller
{
    // ##########################################################
    // @@@@@@@@@@@@@@ Products Page @@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // ##########################################################
   public  function ProductsView($serviceType,$serviceCategory) {
    session()->pull('link');
    $services = Service::all()->sortBy("service");
    $productCategories = ProductCategory::where('service', $serviceType)
    ->orderBy('category', 'asc')
    ->get();
    $globalTags = DB::table('tags')
        ->select('tag')
        ->where('service', $serviceType)
        ->orderBy('tag', 'desc')
        ->get();
    if($serviceCategory == "All"){
        $productBrands = DB::table('products')
        ->select('id','brand')
        ->where('service', $serviceType)
        ->orderBy('id', 'desc')
        ->get();
    }
    else{
        $productBrands = DB::table('products')
        ->select('id','brand')
        ->where(['service'=>$serviceType,'category'=>$serviceCategory])
        ->orderBy('id', 'desc')
        ->get();
    }
// ####################################################################
// ############### Big Machine Filter Starts Here #######################
//  #######################################################################
   if(isset($_GET["priceMin"])){
       $priceMin = $_GET["priceMin"];
       $priceMinLen = strlen($priceMin);
       $priceMax = $_GET["priceMax"];
       $priceMaxLen = strlen($priceMax);
      
//@@@@@@@@@@@@@@@@@@@ If Brand Exist @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    if(isset($_GET["brandsFilter"])){
        $brandfilters = $_GET["brandsFilter"];
 //@@@@@@@@@@@@@@@ If Price Both Exist @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        if($priceMaxLen !== 0 && $priceMinLen !== 0){
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->whereIn("brand",$brandfilters)
                ->whereBetween('currentPrice', [$priceMin, $priceMax])
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->whereIn("brand",$brandfilters)
                    ->whereBetween('currentPrice', [$priceMin, $priceMax])
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);
            }
            if(count($brandfilters) === 1){
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Price Between " . $priceMin . " And " . $priceMax . " Brand:" . implode(",",$brandfilters) ;
            }
            else{
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Price Between " . $priceMin . " And " . $priceMax . " Brands:" . implode(",",$brandfilters) ;
            }
        }
//@@@@@@@@@@@@@@@@@@ if only priceMin Exist @@@@@@@@@@@@@@@@@@@@@@@@@@
       else if($priceMinLen !== 0 && $priceMaxLen == 0){
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->whereIn("brand",$brandfilters)
                ->where('currentPrice','>=', $priceMin)
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->whereIn("brand",$brandfilters)
                    ->where('currentPrice','>=', $priceMin)
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);

            }
            if(count($brandfilters) === 1){
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Minimum Price:" . $priceMin . " Brand:" . implode(",",$brandfilters);
            }
            else{
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Minimum Price:" . $priceMin . " Brands:" . implode(",",$brandfilters) ;
            }
        }
//@@@@@@@@@@@@@@@@@@ if only priceMax Exist @@@@@@@@@@@@@@@@@@@@@@@@@@@@
        else if($priceMinLen == 0 && $priceMaxLen !== 0){
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->whereIn("brand",$brandfilters)
                ->where('currentPrice','<=', $priceMax)
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->whereIn("brand",$brandfilters)
                    ->where('currentPrice','<=', $priceMax)
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);

            }
            if(count($brandfilters) === 1){
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Maximum Price:" . $priceMax . " " . "Brand:" . implode(",",$brandfilters) ;
            }
            else{
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s" . " Maximum Price:" . $priceMax . " " . "Brands:" . implode(",",$brandfilters);
            }
        }
// @@@@@@@@@@@@@@@@@@@@@@@@ if Both Price Not Exist @@@@@@@@@@@@@@@@@@@@@@
         else {
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->whereIn("brand",$brandfilters)
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->whereIn("brand",$brandfilters)
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);

            }
            if(count($brandfilters) === 1){
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Brand:" . implode(",",$brandfilters) ;
            }
            else{
                $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Brands:" . implode(",",$brandfilters) ;
            }
          
        }
        $request = "yes";
      $checkBrandfilters = "yes";
      if(!isset($tagSet)){
        $tagSet = "no need";
    }
    if(!isset($tagSearch)){
    $tagSearch = "no need";
}
    
        return view('products',["products"=>$products,"productBrands"=>$productBrands,"productCategories"=>$productCategories, "services"=>$services,"serviceType"=>$serviceType,"serviceCategory"=>$serviceCategory,"priceMin"=>$priceMin,"priceMax"=>$priceMax,"brandfilters"=>$brandfilters,"checkBrandfilters"=>$checkBrandfilters,"request"=>$request, "searchCriteria" => $searchCriteria,"globalTags"=>$globalTags,"tagSet"=>$tagSet,"tagSearch"=>$tagSearch]);
     }
// @@@@@@@@@@@@@@@@@@@@@@@@@ If Brand Not Exist @@@@@@@@@@@@@@@@@@@@@@@
    else{
        
// @@@@@@@@@@@@@@@@@@@@@ If Both Price  Exist @@@@@@@@@@@@@@@@@@@@@@@@@
        if($priceMaxLen !== 0 && $priceMinLen !== 0){
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->whereBetween('currentPrice', [$priceMin, $priceMax])
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->whereBetween('currentPrice', [$priceMin, $priceMax])
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);
            }
            $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s" . " Price Between:" . $priceMin . " And " . $priceMax ;
        }
// @@@@@@@@@@@@@@@@@@@@@@ if only priceMin Exist @@@@@@@@@@@@@@@@@@@@@@@@@
       else if($priceMinLen !== 0 && $priceMaxLen == 0){
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->where('currentPrice','>=', $priceMin)
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->where('currentPrice','>=', $priceMin)
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);

            }
            $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Minimum Price:" . $priceMin ;
        }
// @@@@@@@@@@@@@@@@@@@@@@@ if only priceMax Exist @@@@@@@@@@@@@@@@@@@@@@@@@
        else if($priceMinLen == 0 && $priceMaxLen !== 0){
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->where('currentPrice','<=', $priceMax)
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->where('currentPrice','<=', $priceMax)
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);

            }
            $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s " . "Maximum Price:" . $priceMax  ;
        }
// @@@@@@@@@@@@@@@@@@@@@@ if Both Price Not Exist @@@@@@@@@@@@@@@@@@@@@@@@@@
         else {
            if($serviceCategory == "All"){
                $products = DB::table('products')
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
                ->paginate(9);
                
            }
            else{
       
                    $products = DB::table('products')
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                    ->paginate(9);

            }
  $searchCriteria = "Search Results: " . $serviceCategory . " " . $serviceType . "s" ;
        }
       
    $request = "yes";
    $checkBrandfilters = "nothing";
    if(!isset($tagSet)){
        $tagSet = "no need";
    }
    if(!isset($tagSearch)){
        $tagSearch = "no need";
    }

    
        return view('products',["products"=>$products,"productBrands"=>$productBrands,"productCategories"=>$productCategories, "services"=>$services,"serviceType"=>$serviceType,"serviceCategory"=>$serviceCategory,"priceMin"=>$priceMin,"priceMax"=>$priceMax,"checkBrandfilters"=>$checkBrandfilters,"request"=>$request,"searchCriteria"=>$searchCriteria,"globalTags"=>$globalTags,"tagSet"=>$tagSet,"tagSearch"=>$tagSearch]);
     }
    
    }
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// ############### Big Machine Filter Ends Here #######################
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// ############### Small Filter Starts Here #######################
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
 else if(isset($_GET["tag"])){
    $tagSearch = $_GET["tag"];
    $tagArray = explode(" ",$tagSearch);
    $products = DB::table('products')
    ->where(['service'=>$serviceType])
    ->Where(function ($query) use($tagArray) {
        for ($i = 0; $i < count($tagArray); $i++){
           $query->orwhere('tags', 'like',  '%' . $tagArray[$i] .'%');
        } }
        )
    ->orderBy('ids', 'desc')
    ->paginate(9);
$request = "yes";
$tagSet = "yes";
if(!isset($priceMin)){
 $priceMin ="no thing";
}
if(!isset($priceMax)){
    $priceMax = "no need";
}
if(!isset($brandfilters)){
    $brandfilters = "no need";
}
if(!isset($checkBrandfilters )){
    $checkBrandfilters = "no need";
}

$searchCriteria = $serviceCategory . " " . $serviceType . "s" ;
    
        return view('products',["products"=>$products,"productBrands"=>$productBrands,"productCategories"=>$productCategories, "services"=>$services,"serviceType"=>$serviceType,"serviceCategory"=>$serviceCategory,"request"=>$request,"priceMin"=>$priceMin,"priceMax"=>$priceMax,"brandfilters"=>$brandfilters,"checkBrandfilters"=>$checkBrandfilters, "searchCriteria"=>$searchCriteria,"globalTags"=>$globalTags,"tagSet"=>$tagSet,"tagSearch"=>$tagSearch]);
}
 
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// ############### Small Filter Ends Here #######################
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    else if($serviceCategory == "All"){
        $products = DB::table('products')
                ->where(['service'=>$serviceType])
                ->orderBy('ids', 'desc')
        ->paginate(9);
    }
    else{
        $products = DB::table('products')
                    ->where(['service'=>$serviceType,'category'=>$serviceCategory])
                    ->orderBy('ids', 'desc')
                   ->paginate(9);
    }
   
$request = "nothing";
if(!isset($priceMin)){
 $priceMin ="no thing";
}
if(!isset($priceMax)){
    $priceMax = "no need";
}
if(!isset($brandfilters)){
    $brandfilters = "no need";
}
if(!isset($checkBrandfilters )){
    $checkBrandfilters = "no need";
}
if(!isset($tagSet)){
    $tagSet = "no need";
}
if(!isset($tagSearch)){
    $tagSearch = "no need";
}





$searchCriteria = $serviceCategory . " " . $serviceType . "s" ;
    
        return view('products',["products"=>$products,"productBrands"=>$productBrands,"productCategories"=>$productCategories, "services"=>$services,"serviceType"=>$serviceType,"serviceCategory"=>$serviceCategory,"request"=>$request,"priceMin"=>$priceMin,"priceMax"=>$priceMax,"brandfilters"=>$brandfilters,"checkBrandfilters"=>$checkBrandfilters, "searchCriteria"=>$searchCriteria,"globalTags"=>$globalTags,"tagSet"=>$tagSet,"tagSearch"=>$tagSearch]);
    }
}




