<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ProductController3 extends Controller
//@@@@@@@@@@@@@@@@@@@@@@@@@ service Crud @@@@@@@@@@@@@@@@@
{
    public function viewServices(){
        if(session()->has('adminLoggedIn')){
            $services = DB::table('services')
                        ->orderBy('service','asc')
                        ->paginate(20);
            return view('admin.admin-view-services',["services"=>$services]);
        }
        else{
            return redirect('admin-login');
        }
    }
    public function editService($id){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
           $servicee = Service::find($id);
        return view('admin.admin-edit-service',['services'=>$services,"servicee"=>$servicee]);
        }
        else{
            return redirect('admin-login');
        }
    }
    public function updateService(Request $req){
        
            $service = $req->service;
            $updateService = Service::find($req->id);
            $changedService = $updateService->service;
            $updateService->service = $service;
            $updateService->save();
            DB::table('product_categories')
                ->where(['service'=> $changedService])
                ->update(['service'=> $updateService->service]);

                DB::table('products')
                ->where(['service'=> $changedService])
                ->update(['service'=> $updateService->service]);

                DB::table('tags')
                ->where(['service'=> $changedService])
                ->update(['service'=> $updateService->service]);
           
            return back()->with('service-updated','Service has been updated successfully');

    }
    public function deleteService($id){
        if(session()->has('adminLoggedIn')){
            $Service = Service::find($id);
            $deletedService = $Service->service;
            $Service->delete();

            DB::table('product_categories')
            ->where(['service'=> $deletedService])
            ->delete();
            DB::table('tags')
            ->where(['service'=> $deletedService])
            ->delete();
         $deletedProducts =   DB::table('products')
            ->select('id','image_1','image_2','image_3')
            ->where(['service'=> $deletedService])
            ->get();
            $deletedProductsId = [];
            foreach($deletedProducts as $deletedProduct ){
                array_push($deletedProductsId,$deletedProduct->id);
                unlink(public_path('ProductImages').'/'.$deletedProduct->image_1);
unlink(public_path('ProductImages').'/'.$deletedProduct->image_2);
unlink(public_path('ProductImages').'/'.$deletedProduct->image_3);
            }
          
            
            DB::table('products')
            ->where(['service'=> $deletedService])
            ->delete();
            DB::table('carts')
            ->whereIn('productId',$deletedProductsId)
            ->delete();
            DB::table('comments')
            ->whereIn('productId',$deletedProductsId)
            ->delete();

return back()->with('service-deleted','Service has been deleted successfully');
        }
        else{
            return redirect('admin-login');
        }

    }
}
