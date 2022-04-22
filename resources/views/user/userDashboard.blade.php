@extends('layouts.user')

@section('content')

<div class="section" style="width: 100%;min-height: 400px;display: flex;justify-content: center;align-items: center">


   <div style="width: 50%;min-height: 300px">
       <div class="google" style="display: flex;justify-content: center;align-items: center">

           <div class="google_img">
              <img src="{{asset('assets/img/google-logo-google-trends-google-images-png-favpng-sxvARS7MfSnRs4hjJzeY8fb8i.jpg')}}" style="width: 100%;height: 100%">
           </div>

       </div>


       <div class="google_inp" style="margin-top: 50px">

           <form class="example" method="GET" action="{{route('search')}}">
               <input type="text" placeholder="Search.." name="search">
               <button type="submit"><i class="fa fa-search"></i></button>
           </form>

       </div>

        @if($posts != "")
       <div style="width: 100%;height: auto;display: flex;justify-content: center">

           <div style="width: 95%;height: auto;display: flex;justify-content: space-around;flex-wrap: wrap">

               @foreach($posts as $post)
                   <a href="" style="width: 20%;height: 250px;background: #bcbec0">
                       <div style="width: 20%;height: 250px;background: #bcbec0;text-align: center">

                           <h1>{{$post->title}}</h1>

                           <h3>{{$post->description}}</h3>

                           <p>{{$post->text}}</p>


                       </div>
                   </a>


               @endforeach



           </div>



       </div>

       @endif





   </div>



</div>


@endsection
