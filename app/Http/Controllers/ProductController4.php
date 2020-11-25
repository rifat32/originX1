<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ProductController4 extends Controller
{
    // @@@@@@@@@@@@@@@@@@@@ Categories Crud @@@@@@@@@@@@@@@@@@@@@@@@@@@@
    public function viewCategories($serviceType){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
        
          $categories =  DB::table('product_categories')
          ->where(['service'=>$serviceType])
          ->orderBy('category','asc')
          ->paginate(20);
 
          
          
            return view('admin.admin-view-cagegories',["services"=>$services,"categories"=>$categories,"serviceType"=>$serviceType]);
        }
        else{
            return redirect('admin-login');
        }
    }
    public function editCategory($id){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
           $category = ProductCategory::find($id);
        return view('admin.admin-edit-category',['services'=>$services,"category"=>$category]);
        }
        else{
            return redirect('admin-login');
        }
    }
    public function updateCategory(Request $req){
        $service = $req->service;
            $category = $req->category;
            $updateCategory = ProductCategory::find($req->id);
            $changedCategory= $updateCategory->category;
            $updateCategory->category = $category;
            $updateCategory->service = $service;
            $updateCategory->save();
           
                DB::table('products')
                ->where(['category'=> $changedCategory])
                ->update(['category'=> $updateCategory->category]);
           
            return back()->with('category-updated','Category has been updated successfully');

    }
    public function deleteCategory($id){
        if(session()->has('adminLoggedIn')){
            $Category = ProductCategory::find($id);
            $deletedCategory = $Category->category;
            $Category->delete();

          
         $deletedProducts =   DB::table('products')
            ->select('id','image_1','image_2','image_3')
            ->where(['category'=> $deletedCategory])
            ->get();
            $deletedProductsId = [];
            foreach($deletedProducts as $deletedProduct ){
                array_push($deletedProductsId,$deletedProduct->id);
            }
            foreach($deletedProducts as $deletedProduct ){
                unlink(public_path('ProductImages').'/'.$deletedProduct->image_1);
                unlink(public_path('ProductImages').'/'.$deletedProduct->image_2);
                unlink(public_path('ProductImages').'/'.$deletedProduct->image_3);
                            }
            DB::table('products')
            ->where(['category'=> $deletedCategory])
            ->delete();
            DB::table('carts')
            ->whereIn('productId',$deletedProductsId)
            ->delete();
            DB::table('comments')
            ->whereIn('productId',$deletedProductsId)
            ->delete();

return back()->with('category-deleted','Category has been deleted successfully');
        }
        else{
            return redirect('admin-login');
        }

    }
}
