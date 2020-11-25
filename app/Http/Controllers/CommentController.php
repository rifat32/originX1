<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  // Post Comment
  public function postComment(Request $req){
      $name = $req->name;
      $comment = $req->comment;
      $productId = $req->productId;
     
   
    DB::table('comments')
    ->insert(['userName'=>$name,'userComment'=>$comment,'productId'=>$productId,'created_at'=>\Carbon\Carbon::now()]);
      return response()->json();

  }
  //  Show Comment
  public function showComents($id){
$comments = DB::table('comments')
            ->where(['productId'=>$id])
            ->orderByDesc('id')
            ->take(10)
            ->get();

            return response()->json($comments);
  }
}
