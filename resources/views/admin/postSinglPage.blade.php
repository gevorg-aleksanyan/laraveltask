@extends('layouts.admin')

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

                           <div>
                               <input type="hidden" value="{{$img->id}}" class="hid_id">
                               <a href="{{route('delete_img',['id' => $img->id])}}">delete</a>
                               <span  class="edit">edit</span>
                           </div>

                       </div>
                       @endforeach
                   </div>



               </div>
            </div>


        </div>

        <div id="id01" class="modal login_modal">

            <form class="modal-content animate" action="{{route('img_edit')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="container">
                    <label for="uname"><b>Image:</b></label>
                    <input type="file" name="img" class="form-control " required >
                    <input type="hidden" class="img_id" name="id" value="">
                    <button type="submit">Edit</button>

                </div>

            </form>
        </div>



    </div>
    <script>
        $( document ).ready(function() {
          $('.edit').click(function (){
              var img_id = $(this).parent().children('.hid_id').val();
              $('.img_id').val(img_id);
              document.getElementById('id01').style.display='block'

          });
        });
        var modal = document.getElementById('id01');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>

@endsection
