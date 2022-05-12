@extends('layouts.admin')

@section('content')


    <h1 class="text-center">New Post</h1>

    <div style="display: flex;justify-content: center">
        <div style="width: 60%;height: auto">
            <form style='margin-top:50px' method='post' action="{{route('edit_post',['id' => $post->id])}}" >

                @csrf
                <input type='text' name='title_edit' value="{{$post->title}}" placeholder='Post title' class="form-control @error('title_edit') is-invalid @enderror" required><br>
                @error('title_edit')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                     </span>
                @enderror
                <input type='text' name='description_edit' value="{{$post->description}}" placeholder='Description'  class="form-control @error('description_edit') is-invalid @enderror" required><br>
                @error('description_edit')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                     </span>
                @enderror
                <textarea  placeholder='Text'  name="post_text_edit" class="@error('post_text_edit') is-invalid @enderror" style="width: 100%;" required>{{$post->text}}</textarea>
                @error('post_text_edit')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                     </span>
                @enderror

                <button type='submit'  style='background:#392a46;color:#fff' class='btn form-control'>Edit Post</button>
            </form>
        </div>
    </div>



@endsection
