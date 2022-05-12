<?php

namespace App\Services;

/**
 * Class ImageService.
 */
class ImageService
{
    public static function moveImage($slug)
    {
//
//        $name_serv = $slug->getClientOriginalName();
//
//        $destinationPath = public_path('admin/img');
//        $slug->move($destinationPath, $name_serv);
//        return  $name_serv;

        $name_serv = $slug->getClientOriginalName();
        $destinationPath = 'public/admin/posts';
        $slug->storeAs($destinationPath, $name_serv);
        return  $name_serv;


    }
}
