@extends('admin.layouts.app')

@section('title')

Edit Permissions

@endsection
<style>
    .alert-custom{
  background-color:#7fad39;
  color:#fff;
}
</style>

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card" >


                <div class="card-header">
                    <h3>Edit Permissions</h3>

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
                    <a href="{{ route('rights.view')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
                <form action="{{ route('rights.update')}}" method="POST">
                    @csrf
                <div class="card-body">
                <input type="hidden" name="id" value="{{$permission->id}}">
                    <div class="form-group">
                        <label for="title">Permission Name<span style="color:red;font-size:15px;" >&nbsp;*</span></label><br>

                        <input type="text" name="permission" class="form-control" value="{{$permission->name}}" placeholder="" ><br>
                    </div>

                            <button type="submit" class="btn btn-primary float-left">Update</button>
                            <a href="{{ route('rights.view')}}"><button type="button" class="btn btn-danger float-left">Cancel</button></a>

                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

