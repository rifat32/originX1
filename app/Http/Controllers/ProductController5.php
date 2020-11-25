<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class ProductController5 extends Controller
{
    //@@@@@@@@@@@@@@@@@@@@@@@@@ Global Tag Crud @@@@@@@@@@@@@@@@@
    public function viewTags($serviceType){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
        
          $tags =  DB::table('tags')
            ->where(['service'=> $serviceType])
            ->orderByDesc('id')
            ->paginate(20);
          
          
            return view('admin.admin-view-tags',["services"=>$services,"tags"=>$tags,"serviceType"=>$serviceType]);
        }
        else{
            return redirect('admin-login');
        }
    }
    public function editTag($id){
        if(session()->has('adminLoggedIn')){
            $services = Service::all()->sortBy("service");
           $tag = Tag::find($id);
        return view('admin.admin-edit-tag',['services'=>$services,"tag"=>$tag]);
        }
        else{
            return redirect('admin-login');
        }
    }
    public function updateTag(Request $req){
        $service = $req->service;
        $tag = $req->tag;
            
            $updateTag = Tag::find($req->id);
            $updateTag->tag = $tag;
            $updateTag->service = $service;
            $updateTag->save();
           
           
            return back()->with('tag-updated','Tag has been updated successfully');

    }
    public function deleteTag($id){
        if(session()->has('adminLoggedIn')){
            $tag = Tag::find($id);
            $tag->delete();
        

return back()->with('tag-deleted','Tag has been deleted successfully');
        }
        else{
            return redirect('admin-login');
        }

    }
}
