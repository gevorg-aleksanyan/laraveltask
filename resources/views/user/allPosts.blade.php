@extends('layouts.user')

@section('content')

    <div style="width: 100%;height: auto;display: flex;justify-content: center">

        <div style="width: 95%;height: auto;display: flex;justify-content: space-around;flex-wrap: wrap">

          @foreach($posts as $post)
                <a href="" style="width: 15%;height: 250px;background: #bcbec0">
                    <div style="width: 15%;height: 250px;background: #bcbec0;text-align: center">

                        <h1>{{$post->title}}</h1>

                        <h3>{{$post->description}}</h3>

                        <p>{{$post->text}}</p>


                    </div>
                </a>


            @endforeach



        </div>



    </div>

@endsection
