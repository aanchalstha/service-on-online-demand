<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
</head>
@extends('admin.layouts.app')

@section('title')

Edit Service

@endsection
<style>
    .mce-notification {display: none !important;}
</style>

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Service Information</h3>

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


                    <a href="{{ route('service.index')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
                <div class="card-body">
                    Fields marked with <span style="color:red;font-size:15px;">&nbsp;*</span> are compulsary.
                <form action="{{ url('admin/update/service', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Service Name:<span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                            <input type="text" name="service_name" class="form-control" value="{{$service->name}}" placeholder="Service Title" ><br>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="Category Select">Service Category Select<span style="color:red;font-size:15px;">&nbsp;*</span></label>
                                <select class="form-control" name="category_id" id="exampleFormControlSelect1"  autocomplete="off">
                                    <option  disabled selected> Select Service Category</option>
                                    @foreach($category as $catData)
                                    @if($catData->id == $service->category_id)
                                    <option value="{{$catData->id}}" selected>{{$catData->name}}</option>
                                   @else
                                    <option value="{{$catData->id}}">{{$catData->name}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                          </div>


                        <div >
                            <label>Select Featured Image<span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                            <input type='file' name="image" onchange="readURL(this);" />
                            <br><br>
                            <img src="{{asset('uploads/services/'.$service->image)}}" id="blah" src="" alt="Uploaded Image will be displayed here." style="width: 200px;;"/>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="title">Service Description <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                            <textarea name="description" rows="5" cols="40" class="form-control tinymce-editor"> {{$service->description}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="title">Service Fee(In Rs.) <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                            <input type="number" step="any" name="service_fee" class="form-control" placeholder="e.g. 2500" value="{{$service->service_charge}}" ><br>
                        </div>
                        <div class="form-group">
                            <label for="title">Service Time Period(In Hours) </label><br>
                            <input type="number" step="any" name="service_time" class="form-control" placeholder="e.g. 2  for 2 Hours" value="{{$service->service_time}}"<br>
                        </div>

                        <div class="form-group">
                            <label for="title">Other Informations <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                            <textarea name="other_information" rows="5" cols="40" class="form-control tinymce-editor">{{$service->other_information}}</textarea>
                           <small>Note: This Information will be displayed after the customers choose the service.</small>

                        </div>
                        <br>

                        @if($service->status==1)

                        <label > <b> Service Active Status </b></label><br>
                        <div class="form-check">



                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">

                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                        Not Active
                        </label>
                        </div>
                @else

                <label > <b> Service Active Status </b></label><br>
                <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" >
                            <label class="form-check-label" for="exampleRadios1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">

                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0" checked>
                        <label class="form-check-label" for="exampleRadios2">
                        Not Active
                        </label>
                        </div>
                        <br>
                @endif


                        <input type="submit" class="btn btn-primary" value="Add">

                    </form>
                </div>

            </div>

        </div>
    </div>


</div>



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
