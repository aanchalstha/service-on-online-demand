
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
                    <a href="{{ route('categories')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                    <h3>Add Sub Category</h3>
                </div>
                <div class="card-body">


                    <form action="{{ action('SubCategoryController@store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Category Select">Product Category Select</label>
                            <select class="form-control" name="cat" id="exampleFormControlSelect1">
                             @foreach($category as $catData)
                                <option value="{{$catData->id}}">{{$catData->name}}</option>
                             @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="cat_title">SubCategory Name:</label><br>
                        <input type="text" name="cat_title" class="form-control" required><br>
                        </div>



                        <input type="submit" class="btn btn-primary" value="Add">
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>




@endsection

  @section('scripts')

  @endsection
