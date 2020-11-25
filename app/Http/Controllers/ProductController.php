<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\Tag;

class ProductController extends Controller
{
    // #####################################################
    // @@@@@@@@@@@@ Add Product View Controll @@@@@@@@@@@@@@@@@
     // #####################################################
    public function addProduct($serviceType){
    if(session()->has('adminLoggedIn')){
      $services = Service::all()->sortBy("service");
      $productCategories = ProductCategory::where('service', $serviceType)
      ->orderBy('category', 'asc')
      ->get();
      if(count($productCategories) == 0){
          return "Please Go Back And Add Category For " . $serviceType ;
      }
      
    
  
            return view('admin.add-product', ["services"=>$services,"productCategories"=>$productCategories,"serviceType"=>$serviceType]);
        }
        else{
            return redirect('admin-login');
        }
    }
      // #####################################################
    // @@@@@@@@@@@@ Add Product Form Controll @@@@@@@@@@@@@@@@@
     // #####################################################
    public function storeProduct(Request $req){
        $ids = $req->ids;
        $service = $req->service;
        $name = $req->name;
        $descriptionIntroduction = $req->descriptionIntroduction;
        $descriptionFeatures = $req->descriptionFeatures;
        $tags = $req->tags;
        $stock = $req->stock;
        if(strlen($stock) == 0){
            $stock  = -1;
        }
        $colors = $req->colors;
        if(strlen($colors) == 0){
            $colors  = -1;
        }
        $sizes = $req->sizes;
        if(strlen($sizes) == 0){
            $sizes  = -1;
        }
        $currentPrice = $req->currentPrice;
        $previousPrice = $req->previousPrice;
        if(strlen($previousPrice) == 0){
            $previousPrice  = -1;
        }
        $productCategory = $req->productCategory;
        $productBrand = $req->productBrand;
        $image1 = $req->file('img1');
        $image2 = $req->file('img2');
        $image3 = $req->file('img3');

        $image1Name = time() . "img1" . "." . $image1->extension();
        $image1->move(public_path('ProductImages'),$image1Name);

        $image2Name = time() . "img2" . "." . $image2->extension();
        $image2->move(public_path('ProductImages'),$image2Name);

        $image3Name = time() . "img3" . "." . $image3->extension();
        $image3->move(public_path('ProductImages'),$image3Name);
       
$Product = new Product();
       
        $Product->ids = $ids;
        $Product->name = $name;
        $Product->descriptionIntroduction = $descriptionIntroduction;
        $Product->descriptionFeatures = $descriptionFeatures;
        $Product->currentPrice = $currentPrice;
        $Product->previousPrice = $previousPrice;
        $Product->service = $service;
        $Product->category = $productCategory;
        $Product->brand = $productBrand;
        $Product->tags = $tags;
        $Product->stock = $stock;
        $Product->sizes = $sizes;
        $Product->colors = $colors;
        $Product->image_1 =   $image1Name;
        $Product->image_2 =   $image2Name;
        $Product->image_3 =   $image3Name;
        $Product->save();
        return back()->with('product-added', 'Product has been inserted' );

      
    }
     // #####################################################
    // @@@@@@@@@@@@ Add Service View Controll @@@@@@@@@@@@@@@@@
     // #####################################################
    public function addService(){
  
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
            return view('admin.add-service',["services"=>$services]);
        }
        else{
            return redirect('admin-login');
        }
    }
       // #####################################################
    // @@@@@@@@@@@@ Add Service Form Controll @@@@@@@@@@@@@@@@@
     // #####################################################
    public function storeService(Request $req){
        $service = $req->service;
     $serviceTable = new Service(); 
     $serviceTable->service = $service;
      $serviceTable->save();
        return back()->with('service-added', 'Service has been inserted' );  
    }
       // #####################################################
    // @@@@@@@@@@@@ Add Product Category View Controll @@@@@@@@@@@@@@@@@
     // #####################################################
    public function addProductCategory(){
  
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
            if(count($services) ==0){
                return "Go Back And Add Service First";
            }
            return view('admin.add-product-category',["services"=>$services]);
        }
        else{
            return redirect('admin-login');
        }
    }
     // #####################################################
    // @@@@@@@@@@@@ Add Product Category Form Controll @@@@@@@@@@@@@@@@@
     // #####################################################
    public function storeProductCategory(Request $req){
        $service= $req->categoryFor;
        $category = $req->category;
       

        $ProductCategory = new ProductCategory();
        $ProductCategory->category = $category;
        $ProductCategory->service = $service;
        $ProductCategory->save();
        return back()->with('product-category-added', 'Product Category has been inserted' );

    }
      // #####################################################
    // @@@@@@@@@@@@ Add Global Tags View Controll @@@@@@@@@@@@@@@@@
     // #####################################################
     public function addGlobalTags(){
  
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
            return view('admin.add-global-tags',["services"=>$services]);
        }
        else{
            return redirect('admin-login');
        }
    }
      // #####################################################
    // @@@@@@@@@@@@ Add Global Tags Form Controll @@@@@@@@@@@@@@@@@
     // #####################################################
     public function storeGlobalTag(Request $req){
        $service= $req->tagFor;
        $tag = $req->tag;
       

        $GlobatTag = new Tag();
        $GlobatTag->tag = $tag;
        $GlobatTag->service = $service;
        $GlobatTag->save();
        return back()->with('global-tag-added', 'Global Tag has been inserted' );

    }
 
}
