@extends('layouts.admin')

@section('content')


    <h1 class="text-center">New Post</h1>

    <div style="display: flex;justify-content: center">
        <div style="width: 60%;height: auto">
            <form style='margin-top:50px' method='post' action="{{route('create_post')}}" enctype="multipart/form-data">

                @csrf
                <input type='text' name='title_add' placeholder='Post title' class='form-control @error('title_add') is-invalid @enderror' required><br>
                @error('title_add')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                     </span>
                @enderror
                <input type='text' name='description_add' placeholder='Description' class='form-control @error('description_add') is-invalid @enderror' required><br>
                @error('description_add')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                     </span>
                @enderror
                <textarea  placeholder='Text' name="post_text_add"class="@error('post_text_add') is-invalid @enderror" style="width: 100%;" required></textarea>
                @error('post_text_add')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                     </span>
                @enderror
                <input type='file' name='image[]'  class='form-control' id="photo" multiple="multiple" ><br>
                <button type='submit'  style='background:#392a46;color:#fff' class='btn form-control'>Add Product</button>
            </form>
        </div>
    </div>

    <script>
        $("#photo").on("change", function() {
            if ($("#photo")[0].files.length > 20) {
                alert("You can select only 20 images");

            }

        });
    </script>

@endsection
