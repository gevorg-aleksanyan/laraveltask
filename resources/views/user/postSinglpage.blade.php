@extends('layouts.user')

@section('content')


        <div style="width: 100%;height: auto;display: flex;justify-content: center">

            <div style="width: 90%;">

                <div style="display: flex;justify-content: center;width: 80%;">
                    <div>

                        <h1>{{$post->title}}</h1>
                        <h3>{{$post->description}}</h3>
                        <div style="width: 80%;height: auto;padding: 0 10px">
                            <p style="padding: 5px;width: 100%;">{{$post->text}}</p>
                        </div>

                        <div style="margin-top: 100px;display: flex;flex-wrap: wrap;width: 100%;">
                            @foreach($image as $img)
                                <div style="width: 150px;height: 150px;margin:10px 10px">

                                    <img src="{{asset('admin/img/'.$img->image)}}" style="width: 100%;height: 100%">



                                </div>
                            @endforeach
                        </div>



                    </div>
                </div>


            </div>



        </div>





@endsection
