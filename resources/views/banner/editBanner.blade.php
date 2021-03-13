
@extends('admin.layouts.app')

@section('title')

Edit Banner Image

@endsection


@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Banner Image</h3>

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

                    <a href="{{ route('bannerImages')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/banner/update/'.$banner->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Banner Title:</label><br>
                            <input type="text" name="banner_title" class="form-control" placeholder="Banner Title" value="{{$banner->banner_title}}"><br>
                        </div>
                        <div class="form-group">
                            <label for="title">Banner Sub Title:</label><br>
                        <input type="text" name="banner_subtitle" class="form-control" placeholder="Banner Sub Title" value="{{$banner->banner_subtitle}}" ><br>
                        </div>

                        {{-- <div class="form-group">
                            <label for="Category Select">Banner Category Select</label>
                            <select class="form-control" name="category" id="exampleFormControlSelect1">
                            @foreach($category as $catData)
                                <option value="{{$catData->id}}">{{$catData->name}}</option>
                            @endforeach
                            </select>
                        </div> --}}

                        <div >
                            <label>Select Image</label><br>
                            <input type='file' name="image" onchange="readURL(this);" />
                            <br><br>
                            <img id="blah" src="{{ asset('banner_uploads') . '/' . $banner->image }}" alt="Uploaded Image will be displayed here." style="width: 180px;height:100px;"/>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Update">
                    </form>
                </div>

            </div>

        </div>
    </div>


</div>



@endsection

  @section('scripts')
  <script>
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
