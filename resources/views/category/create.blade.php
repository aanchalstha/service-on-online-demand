
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
                    <h3>Add New Course Category</h3>

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


                    <form action="{{ url('admin/service-categories/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                        <label for="cat_title" required>Category Name:</label><br>
                        <input type="text" name="category_title" class="form-control" ><br>
                        </div>

                        <div class="form-group">
                            <label for="cat_title" required>Category Description:</label><br>
                          <textarea name="description" class="form-control" id="description" cols="117" rows="10"></textarea>
                            </div>

                        <div >
                            <label for="Select Image">Select Image of Category</label><br>

                            <input type='file' onchange="readURL(this);" name="catimage"  />
                            <br><br>
                            <img id="blah" alt="Uploaded Image will be displayed here." style="width: 100px;height:100px;" />
                         </div><br>
                         <label>Category Status</label>
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


                        <input type="submit" class="btn btn-primary" value="Add">
                        <a href="{{ route('categories')}}" class="btn btn-danger">  Go Back</a>
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
