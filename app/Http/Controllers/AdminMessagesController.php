<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class AdminMessagesController extends Controller
{
    public function viewMessages(){

if(session()->has('adminLoggedIn')){
    $services = Service::all()->sortBy("service");
   $messages = DB::table('contact_messages')
               ->orderByDesc('id')
               ->paginate(20);
    return view('admin.messages',['services'=>$services,'messages'=>$messages]);
}
else{
    return redirect('admin-login');
}
    }
    public function deleteMessage($id){

        if(session()->has('adminLoggedIn')){

            DB::table('contact_messages')
            ->where(['id'=>$id])
            ->delete();
            
                     
            return back()->with('message-deleted', 'Message has been deleted Successfully!');
        }
        else{
            return redirect('admin-login');
        }
            }
}
