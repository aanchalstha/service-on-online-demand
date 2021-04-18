@extends('admin.layouts.app')

@section('title')

Add Banner Image

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
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Banner Image Listing</h4>

              @if(session()->has('message'))
              <div class="alert alert-custom">{{session()->get('message')}}</div>
           @elseif(session()->has('error'))
              <div class="alert alert-danger">{{session()->get('error')}} </div>
          @endif

              <a href="{{url('/admin/add-banner-image')}}" class="btn btn-primary ">Add New Banner Image</a>




            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <table id="banners-table" class="table table-striped table-bordered">
                            <thead>
                                <tr style="font-size: 16px;font-weight:bold; ">
                                    <td >
                                        ID
                                    </td>
                                    <td>
                                        Banner Image
                                    </td>
                                    <td>
                                        Banner Title
                                    </td>


                                    <td >
                                       Banner Sub Title
                                    </td>

                                    <td >
                                    Actions
                                    </td>
                                </tr>
                            </thead>
                            @foreach($banners as $banner)
                            <tbody>
                                <tr>
                                    <td>{{$banner->id}}</td>
                                <td> <img src="{{asset('banner_uploads/'.$banner->image)}}" alt="" style="width:200px;"> </td>
                                    <td>{{$banner->banner_title}}</td>
                                    <td>{{$banner->banner_subtitle}}</td>
                                    <td>


                                        <form method="POST" action="{{route('banner.delete', $banner->id)}}">
                                            @csrf
                                            <a href="{{route('banner.edit', $banner->id)}}" class="edit btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                            <input name="_method" type="hidden" value="POST">
                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
                                        </form>
                                    </td>

                                </tr>
                            </tbody>
                            @endforeach
                    </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>






@endsection

@section('scripts')
<script>
     $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Banner Image?')) {
            e.preventDefault();
        }
    });
    $("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 5000 ); // 5 secs
    });
</script>
@endsection

