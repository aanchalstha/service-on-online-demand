
@extends('admin.layouts.app')


@section('title')

Add Service Provider

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Service Provider</h3>

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

                    <a href="{{ route('service-provider.index')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
                <div class="card-body">


                    <form action="{{ url('admin/add-service-provider') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                        <label for="name" required>Full Name:</label><br>
                        <input type="text" name="name" class="form-control" ><br>
                        <div >
                            <label for="Select Image">Select Display Image:</label><br>

                            <input type='file' onchange="readURL(this);" name="image"  />
                            <br><br>
                            <img id="blah" alt="Uploaded Image will be displayed here." style="width: 100px;height:100px;" />
                         </div><br>
                            <label for="position" required>Select Category of Service:</label><br>
                            <select class="form-control" name="category_id" id="exampleFormControlSelect1"  autocomplete="off">
                                <option  disabled selected> Select Service Category</option>
                                @foreach($category as $catData)
                                <option value="{{$catData->id}}">{{$catData->name}}</option>
                            @endforeach
                            </select>
                            </div>

                        <div class="form-group">
                            <label for="text" required>Description:</label><br>
                          <textarea name="description" class="form-control" id="description" cols="117" rows="5"></textarea>
                            </div>

                            <label for="position" required>Enter Amount/Rate Of Service (Per Service):</label><br>
                            <input type="number" name="rate" class="form-control" min="0"><br>

                            <label > <b> Service Provider Status </b></label><br>
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

                        <br>
                        <input type="submit" class="btn btn-primary" value="Add">
                        <a href="{{ route('service-provider.index')}}" class="btn btn-danger">  Go Back</a>
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
