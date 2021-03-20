@extends('admin.layouts.app')

@section('title')

Sub Categories Listing

@endsection


@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Sub Categories Listing</h3>
                </div>

                    <div class="container">
                        <br>
                        <a href="{{ url('admin/service/categories')}}" class="btn btn-primary">Go Back</a>
                        <br>
                       @if(count($subcat)>0)

                       <table class="table table-hover table-bordered">
                        <thead>
                            <th>Id</th>
                            <th>Sub Name</th>
                            <th>Status</th>
                             <th>Action</th>

                        </thead>
                        @foreach($subcat as $subcat)

                        <tbody>

                                 <td> {{$subcat->id}}</td>
                                <td>{{$subcat->name}}</td>
                                @if ($subcat->status==1)<td style="color:green;"> Active </td>
                                @else<td style="color:red;"> Not Active</td>
                                @endif

                                <td>

                                <form method="POST" action="{{url('admin/service-subcat/delete/'.$subcat->id)}}">
                                    @csrf
                                    <input name="_method" type="hidden" value="POST">
                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
                                </form>
                            </td>
                        </tbody>
                        @endforeach





                       @else
                       Sorry ! No Subcategory found associated with this Course Category !!
                       @endif


                    </div>
               </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Sub Category?')) {
            e.preventDefault();
        }
    });
</script>
@endsection
