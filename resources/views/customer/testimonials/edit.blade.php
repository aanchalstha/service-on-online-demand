
@extends('customer.layouts.app')


@section('title')

Edit Review

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Review</h3>

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

                    <a href="{{ route('view.testimonial')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
                <div class="card-body">


                    <form action="{{ url('customer/update/review', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                        <label for="name" required>Please Enter Your Full Name: <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                        <input type="text" name="name" class="form-control" value="{{$data->name}}"><br>

                            <label for="position" required>Enter your Designation: <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                            <input type="text" name="position" class="form-control" value="{{$data->position}}" ><br>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="Category Select">Select a Service to Review <span style="color:red;font-size:15px;">&nbsp;*</span></label>
                                <select class="form-control" name="service_request_id" id="exampleFormControlSelect1"  autocomplete="off">
                                    <option  disabled selected> Select Completed Service</option>
                                    @foreach($services as $service)
                                    @if($data->service_request_id == $service->id)
                                    <option value="{{$service->id}}" selected>{{$service->service_name}}, Service Date: {{$service->service_date}}, Service Provider: {{$service->service_provider}}</option>
                                   @else
                                   <option value="{{$service->id}}">{{$service->service_name}}, Service Date: {{$service->service_date}}, Service Provider: {{$service->service_provider}}</option>
                                   @endif
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="text" required>Enter Review Text: <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>
                          <textarea name="text" class="form-control" id="description" cols="117" rows="5">{{$data->text}}</textarea>
                            </div>

                        <div >
                            <label for="Select Image">Select Your Display Image: <span style="color:red;font-size:15px;">&nbsp;*</span></label><br>

                            <input  type='file' onchange="readURL(this);" name="image"  />
                            <br><br>
                            <img src="{{asset('uploads/testimonials/'.$data->image )}}" id="blah" alt="Uploaded Image will be displayed here." style="width: 100px;height:100px;" />
                         </div> @if($data->status==1)
                         <br><br>
                         <label > <b> Active Status </b></label><br>
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
                 <label > <b> Active Status </b></label><br>
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
                        <a href="{{ route('view.testimonial')}}" class="btn btn-danger">  Go Back</a>
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
