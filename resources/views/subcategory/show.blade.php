@extends('admin.layouts.app')

@section('title')

Product Index

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Categories Listing</h3>
                        <a href="{{url('/product-categories')}}" class="btn btn-primary ">Add New Category</a>&nbsp;&nbsp;&nbsp;
                        <a href="{{url('/product-categories')}}" class="btn btn-primary ">Add Sub Category</a>

                </div>





                    <br>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created By</th>

                                <th>Action</th>

                            </thead>
                            @foreach($category as $cat)

                            <tbody>

                                     <td> {{ $cat->id}}</td>
                                    <td> {{ $cat->name}}</td>
                                    @if ($cat->status==1)<td style="color:green;"> Active </td>
                                    @else<td style="color:red;"> Not Active</td>
                                    @endif
                                    <td>{{ $cat->created_by}}</td>
                                    <td>
                                   <center> <a href="{{url('product-categories/delete/'.$cat->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></center>
                                    </a>
                                    </td>
                            </tbody>
                            @endforeach







                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
