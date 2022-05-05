<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
//        public function __construct()
//    {
//        $this->middleware('auth');
//        $this->middleware('user');
//    }



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
        $text =[];
        $desc  = [];
        $title = [];
       foreach ($posts as $post){
           if($post != ""){
               if($post['title'] == $search){
                   $title[] = $post;
               }elseif ($post['description'] == $search){
                   $desc [] = $post;
               }elseif($post['text'] == $search){
                   $text [] = $post;
               }
           }
       }
       $new_post = array_merge($title,$desc,$text);





       return view('user/userDashboard',['posts'=>$new_post]);

   }

    public function post_singl($id){
    $post=Post::find($id);
    $image =  $post->image;
    return view('user/postSinglpage',compact('post','image'));
    }
}
