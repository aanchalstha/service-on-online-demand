@extends('admin.layouts.app')


@section('title')

Add Category

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">



                    <h3>Edit Course Category</h3>

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

                    <a href="{{ route('categories')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
                <div class="card-body">


                    <form action="{{ url('admin/service-categories/update/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                        <label for="cat_title">Category Name:</label><br>
                        <input type="text" name="category_title" value="{{$category->name }}" class="form-control" ><br>
                        </div>
                        <div class="form-group">
                            <label for="cat_title" required>Category Description:</label><br>
                          <textarea name="description" id="description" cols="117" rows="10" >{{$category->description }}</textarea>
                            </div>



                            <label for="Select Image">Select Image of Category to Update</label><br>

                          <input type='file' name="image" onchange="readURL(this);" />
                          <br><br>
                          <label for="Select Image">Existing Image</label><br>
                          <img id="blah" src="{{ asset('uploads/') . '/' . $category->image }}" class="image" style="width: 100px;height:100px;" />



                         @if($category->status==1)
                         <br><br>
                         <label > <b> Category Status </b></label><br>
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
                 <br><br>
                 <label > <b> Category Status </b></label><br>
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

                         <br>
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a href="{{ route('categories')}}"><input type="button" class="btn btn-danger" value="Go Back"></a>
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
