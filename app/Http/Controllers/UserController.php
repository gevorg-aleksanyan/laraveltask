<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
       $posts = [];
       return view('user/userDashboard',['posts'=>$posts]);;
   }

   public function all_post(){
       $posts = Post::all();
       return view('user/allPosts',['posts'=>$posts]);
   }

   public function search(Request $request){
       $search = $request->search;
       $posts = Post::where('title', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%")->orWhere('text', 'LIKE', "%{$search}%")->get();
       return view('user/userDashboard',['posts'=>$posts]);

   }
}
