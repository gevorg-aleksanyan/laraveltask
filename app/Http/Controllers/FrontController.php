<?php

namespace App\Http\Controllers;


class FrontController extends Controller
{


    public function __construct()
    {
        $this->middleware('front');
    }

    public function index()
    {
        return view('index');
    }
}
