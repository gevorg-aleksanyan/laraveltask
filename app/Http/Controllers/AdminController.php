<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreValidationRequest;
use App\Models\Image;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Str;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{


    public function index(){
        $posts=Post::all();

        return view('admin/adminDashboard',compact('posts'));
    }

    public function createPostPage(){

        return view('admin/addPost');
    }

    public function createPost(StoreValidationRequest $request){
        $post = Post::create([
            'title' => $request->title_add,
            'description' => $request->description_add,
            'text' => $request->post_text_add,
        ]);
        $images =[];
        if($files =$request->file('image')) {
               for($i=0;$i<count($files);$i++) {
                   $img_serv =new imageService();
                   $img_name=$img_serv->moveImage($files[$i]);
                   $images[] = $img_name;
               }
            $imgcount = Image::where('post_id',$post->id)->get();
            if(count($imgcount)<20) {
                if ($images != '') {
                    foreach ($images as $image) {
                        $img = new Image();
                        $img->post_id = $post->id;
                        $img->image = $image;
                        $img->save();
                    }
                }
            }

        }

        return redirect()->route('admin_dashboard');
    }

    public function seePost($id){
        $post=Post::find($id);
        $image =  $post->image;
        return view('admin.postSinglPage',compact('post','image'));

    }
    public function editPostPage($id){
        $post=Post::find($id);
        return view('admin.editPost',compact('post'));

    }
    public function editPost(Request $request,$id){
        $request->validate([
            'title_edit' => ['required', 'string', 'max:255'],
            'description_edit' => ['required', 'string', 'max:255'],
            'post_text_edit' => ['required', 'string'],

        ]);

        $post =Post::find($id);
        $post->title = $request->title_edit;
        $post->description = $request->description_edit;
        $post->text = $request->post_text_edit;
        $post->update();
        return redirect()->route('admin-dashboard');
    }
    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();

        $image = Image::where('post_id',$id)->get();
        foreach ($image as $img){
            $image_path = public_path('storage/admin/posts').'/'.$img->image;
            if($image_path){
                unlink($image_path);
                $img->delete();
            }
        }
        return redirect()->back();
    }
    public function deleteImg($id){
        $post = Image::find($id);;
        $image_path = public_path('storage/admin/posts').'/'.$post->image;
        if($image_path){
            unlink($image_path);
            $post->delete();
        }

        $post->delete();
        return redirect()->back();


    }
    public function imgEdit(Request $request){
        if($request->img != ''){
           $image=Image::find($request->id);
           if($image != ''){
               $img_serv =new imageService();
               $img_name=$img_serv->moveImage($request->img);
               $image->image = $img_name;
               $image->update();
           }
        }
        return redirect()->back();
    }
}
