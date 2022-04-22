<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        $posts=Post::all();

        return view('admin/adminDashboard',compact('posts',$posts));
    }

    public function create_post_page(){

        return view('admin/addPost');
    }

    public function create_post(Request $request){

        $request->validate([
            'title_add' => ['required', 'string', 'max:255'],
            'description_add' => ['required', 'string', 'max:255'],
            'post_text_add' => ['required', 'string'],

        ]);

         $post = new Post();
         $post->title = $request->title_add;
         $post->description = $request->description_add;
         $post->text = $request->post_text_add;
         $post->save();

         $images = $request->image;
         for($i=0; $i<count($images);$i++){
             $imgcount = Image::where('post_id',$post->id)->get();
             if(count($imgcount) <= 20){
                 $img = new Image();
                 $imageName = time() . '.' . $images[$i]->extension();
                 $images[$i]->move(public_path('assets/uploads'), $imageName);
                 $img->post_id = $post->id;
                 $img->image = $imageName;
                 $img->save();
             }
         }


        return redirect()->route('admin_dashboard');
    }

    public function see_post($id){
        $post=Post::find($id);
        $image =  $post->image;
        return view('admin/postSinglPage',compact('post','image'));

    }
    public function edit_post_page($id){
        $post=Post::find($id);
        return view('admin/editPost',compact('post'));

    }
    public function edit_post(Request $request){
        $request->validate([
            'title_edit' => ['required', 'string', 'max:255'],
            'description_edit' => ['required', 'string', 'max:255'],
            'post_text_edit' => ['required', 'string'],

        ]);

        $post =Post::find($request->id);
        $post->title = $request->title_edit;
        $post->description = $request->description_edit;
        $post->text = $request->post_text_edit;
        $post->update();
        return redirect()->route('admin_dashboard');
    }
    public function delete_post($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();


    }
}
