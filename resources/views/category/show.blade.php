@extends('admin.layouts.app')
@section('title')

Category Index

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
                        <h3>Service Categories Listing</h3>

                        @if(session()->has('message'))
                        <div class="alert alert-custom">{{session()->get('message')}}</div>
                     @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}} </div>
                    @endif

                            <a href="{{url('/admin/service-categories')}}" class="btn btn-primary ">Add Category</a>&nbsp;&nbsp;&nbsp;

                    </div>
                    <br>
                    <div class="card-body">

                        <table id="categories-table" class="table table-striped table-bordered">
                            <thead>
                                <tr style="font-size: 16px;font-weight:bold; width: 500%;">
                                    <td >
                                        ID
                                    </td>
                                    <td>
                                       Category Name
                                    </td>
                                    <td>
                                        Featured Image
                                    </td>
                                    <td>
                                        Description
                                    </td>
                                    <td>
                                        Status
                                    </td>

                                    <td >
                                        Actions
                                    </td>

                                </tr>

                            </thead>
                            @foreach($categories as $categories)
                            <tbody>
                                <td>
                                    {{$categories->id }}
                                </td>
                                <td>
                                    {{$categories->name }}
                                </td>
                                <td>
                                    <img src="{{asset('uploads/'.$categories->image )}}" style="width: 200px;height:100px;" />
                                </td>
                                <td>
                                    {{$categories->description }}
                                </td>

                                <td>
                                    @if ($categories->status==1)
                                        <span style="color:green;">Active</span>

                                   @else
                                       <span style="color:red;">Not Active</span>

                                    @endif
                                </td>
                                <td>

                                    {{-- <a href="{{route('delete.category', $categories->id)}}" class="edit btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                    <form method="POST" action="{{route('delete.category', $categories->id)}}">
                                        @csrf
                                        <input name="_method" type="hidden" value="POST">
                                        <a href="{{route('edit.category', $categories->id)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
                                    </form>
                                </td>

                            </tbody>
                            @endforeach
                        </table>



                    </div>
            </div>
        </div>
    </div>
 </div>


@endsection
@section('scripts')
<script>
     $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Category?')) {
            e.preventDefault();
        }
    });

</script>
@endsection
