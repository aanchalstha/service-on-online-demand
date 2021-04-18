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
                    <h3>Sub Categories Listing</h3>
                        <a href="{{url('/admin/service-subcat')}}" class="btn btn-primary ">Add Sub Category</a>

                </div>





                    <br>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Id</th>
                                <th>Sub Category Name</th>
                                <th>Category Name</th>

                                <th>Action</th>

                            </thead>
                            @php $counter = 1; @endphp
                            @foreach($subcat as $cat)

                            <tbody>

                                     <td> {{ $counter }}</td>
                                    <td> {{ $cat->subcat_name}}</td>
                                    <td> {{ $cat->category_name}}</td>


                                    <td>
                                        <form method="POST" action="{{route('subcategory.delete', $cat->subcat_id)}}">
                                            @csrf
                                            <input name="_method" type="hidden" value="POST">
                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
                                        </form>


                                    </a>
                                    </td>
                            </tbody>
                            @php $counter++; @endphp
                            @endforeach







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
        if(!confirm('Are you sure you want to delete this Sub Category?')) {
            e.preventDefault();
        }
    });

</script>
@endsection
