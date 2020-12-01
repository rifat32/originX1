<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController2 extends Controller
{
    //@@@@@@@@@@@@@@@@@@@@@@@@@ Product Crud @@@@@@@@@@@@@@@@@
    // view Products
    public function allProducts(){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
        $products = DB::table('products')
                    ->select('id','ids','name','image_1','category') 
                    ->orderByDesc('ids')
                    ->paginate(20);
return view('admin.all-products',['services'=>$services,'products'=>$products]);
        }
        else{
            return redirect('admin-login');
        }
       
    }
    public function viewProducts($serviceType){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
        $products = DB::table('products')
                    ->select('id','ids','name','image_1','category')
                    ->where(['service'=>$serviceType])
                    ->orderByDesc('ids')
                    ->paginate(20);
return view('admin.admin-view-products',['serviceType'=>$serviceType,'services'=>$services,'products'=>$products]);
        }
        else{
            return redirect('admin-login');
        }
       
    }
    // Edit Product
    public function editProduct($id){   
if(session()->has('adminLoggedIn')){
    $services = Service::all()->sortBy("service");
    $product = Product::find($id);
return view('admin.admin-edit-product',['services'=>$services,'product'=>$product]);
}
else{
    return redirect('admin-login');
}
    }
    // Update Product
    public function updateProduct(Request $req){
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
        // Find Product
        $Product = Product::find($req->id);
        // unlink(public_path('ProductImages').'/'.$Product->image_1);
        // unlink(public_path('ProductImages').'/'.$Product->image_2);
        // unlink(public_path('ProductImages').'/'.$Product->image_3);
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
        // updated current price is
        $updatedCurrentPrice =  $Product->currentPrice;
        
$updateCarts = DB::table('carts')
              ->select('productQuantity')
              ->where(['productId'=>$req->id])
              ->get();
              if(count($updateCarts) !== 0){
foreach($updateCarts as $updateCart){
$updateCartTotalPrice = $updatedCurrentPrice * $updateCart->productQuantity;
               DB::table('carts')
               ->whereIn('orderStatus',['Active','Canceled','inCart'])
              ->update(['productPrice'=> $updatedCurrentPrice,'productTotalPrice'=>$updateCartTotalPrice,'productImage'=>$Product->image_1,"productName"=>$Product->name]);
              
}
              }
       
return back()->with('product-updated','Product has been updated successfully');
    }
    public function deleteProduct($id){
        if(session()->has('adminLoggedIn')){
            $Product = Product::find($id);
unlink(public_path('ProductImages').'/'.$Product->image_1);
unlink(public_path('ProductImages').'/'.$Product->image_2);
unlink(public_path('ProductImages').'/'.$Product->image_3);
$Product->delete();
DB::table('carts')
->where(['productId'=>$id])
->delete();
DB::table('comments')
->where(['productId'=>$id])
->delete();
return back()->with('product-deleted','Product has been deleted successfully');
        }
        else{
            return redirect('admin-login');
        }

    }

}
