 
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
</head>

@extends('admin.layouts.app')

@section('title')
Blog Edit
@endsection

<style>
    .mce-notification {display: none !important;}
</style>

<body>

    @section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12" >
              <div class="card" >
                <div class="card-header">
                  <h4 class="card-title">Edit Blog</h4>

                  @if($errors->count() > 0)
                  <div class="alert alert-danger">
                      Validation Error:
                      <ul class="list-unstyled">
                          @foreach($errors->all() as $error)
                              <li>{{ ucfirst($error) }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif

                  @if(session()->has('message'))
                  <div class="alert alert-success">{{session()->get('message')}}</div>
               @elseif(session()->has('error'))
                  <div class="alert alert-danger">{{session()->get('error')}} </div>
              @endif


                </div>
                <div class="card-body">
                <form method="post" action="{{ route('blog.update') }}" class="form form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">

                    <div class="form-group">
                        <label>Title<span style="color:red;font-size:15px;">&nbsp;*</span></label>
                        <input type="text" name="title" class="form-control"/ value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="Category Select">Select Blog Category<span style="color:red;font-size:15px;">&nbsp;*</span></label>
                        <select class="form-control" name="category" id="exampleFormControlSelect1">
                         @foreach($category as $catData)
                            <option value="{{$catData->id}}">{{$catData->name}}</option>
                         @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label>Description <span style="color:red;font-size:15px;">&nbsp;*</span></label>
                        <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor" value=""> @if(!old('body'))
                            {!! $post->body !!}
                            @endif
                            {!! old('body') !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Featured Image <span style="color:red;font-size:15px;">&nbsp;*</span><br>
                        Click Below to Upload Feature Image of the Article.</label>
                    <input type="file" src=""  name="image" onchange="readURL(this);" />
                            <br><br>
                            <img id="blah" src="{{ asset('uploads/blogs/'.$post->image)}}" alt="Uploaded Image will be displayed here." style="height:120px; width:120px;"/>

                    </div>
                    <div class="form-group">
                        @if($post->active == '1')
                            <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
                        @else
                            <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                        @endif
                         <input type="submit" name='save' class="btn btn-primary" value = "Save As Draft" />
                        <a href="{{  url('admin/delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js" referrerpolicy="origin"></script>

@section('scripts')
<script>

tinymce.init({
  selector: 'textarea.tinymce-editor',
  height: 300,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | image code' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_css: '//www.tiny.cloud/css/codepen.min.css',

  forced_root_block :false,
  force_br_newlines : true,
  force_p_newlines : false,
  images_upload_url: 'postAcceptor.php',

  images_upload_handler: function (blobInfo, success, failure) {
    setTimeout(function () {
      /* no matter what you upload, we will turn it into TinyMCE logo :)*/
      success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
    }, 2000);
  },
});



         function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
