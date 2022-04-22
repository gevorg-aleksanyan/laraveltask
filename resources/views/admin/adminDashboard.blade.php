@extends('layouts.admin')

@section('content')
<div>
    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Text</th>
            <th>See More</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
       @foreach($posts as $post)
           <tr>
               <td>{{$post->title}}</td>
               <td>{{$post->description}}</td>
               <td>{{$post->text}}</td>
               <td><a href="{{route('see',['id' => $post->id])}}">see more</a></td>
               <td><a href="{{route('edit',['id' => $post->id])}}">edit</a></td>
               <td><a href="{{route('delete',['id' => $post->id])}}">delete</a></td>
           </tr>
       @endforeach
        </tbody>


    </table>


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
</div>

@endsection
