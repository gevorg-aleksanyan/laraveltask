<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;
use Symfony\Component\Console\Input\Input;

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

        $images =array();

        if($files =$request->file('image')) {

               for($i=0;$i<count($files);$i++) {
                   $img_serv =new imageService();
                   $img_name=$img_serv->moveImage($files[$i]);
                   $images[] = $img_name;
               }
            $imgcount = Image::where('post_id',$post->id)->get();;
            if(count($imgcount)<20) {
                if ($images != '') {
                    foreach ($images as $p) {

                        $img = new Image();
                        $img->post_id = $post->id;
                        $img->image = $p;
                        $img->save();
                    }
                }
            }

        }

        return redirect()->route('admin-dashboard');
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
        return redirect()->route('admin-dashboard');
    }
    public function delete_post($id){
        $post = Post::find($id);
        $post->delete();

        $image = Image::where('post_id',$id)->get();
        foreach ($image as $img){
            $image_path = 'admin/img/'.$img->image;
            if(File::exists($image_path)) {
                File::delete($image_path);
                $img->delete();
            }
        }
        return redirect()->back();


    }
    public function delete_img($id){
        $post = Image::find($id);;
        $image_path = 'admin/img/'.$post->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $post->delete();
        return redirect()->back();


    }
    public function img_edit(Request $request){

        if($request->img != ''){
           $image=Image::find($request->id);
            $img_serv =new imageService();
            $img_name=$img_serv->moveImage($request->img);
                $image->image = $img_name;
                $image->update();
        }
        return redirect()->back();
    }
}
