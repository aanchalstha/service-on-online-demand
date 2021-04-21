@extends('customer.layouts.app')
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
                        <h5>Reviews and Feedbacks Listing</h5>

                        @if(session()->has('message'))
                        <div class="alert alert-custom">{{session()->get('message')}}</div>
                     @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}} </div>
                    @endif

                    <a href="{{url('customer/add/review')}}" class="btn btn-primary ">Add New Review/Feedback</a>&nbsp;&nbsp;&nbsp;


                    </div>
                    <br>
                    <div class="card-body">

                        <div class="table-responsive">
                        <table id="categories-table" class="table table-striped table-bordered">
                            <thead>
                                <tr style="font-size: 16px;font-weight:bold; width: 500%;">
                                    <td >
                                        ID
                                    </td>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                       Display Image
                                    </td>
                                    <td >
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
                            @php $counter =1; @endphp
                            @foreach($testimonials as $testimonial)
                            <tbody>
                                <td>
                                    {{$counter }}
                                </td>
                                <td>
                                    {{$testimonial->name }}
                                </td>
                                <td>
                                    <img src="{{asset('uploads/testimonials/'.$testimonial->image )}}" style="width: 100px;height:100px;" />
                                </td>
                                <td style="width:20rem;">
                                    {{$testimonial->text }}
                                </td>

                                <td>
                                    @if ($testimonial->status==1)
                                        <span style="color:green;">Active</span>

                                   @else
                                       <span style="color:red;">Not Active</span>

                                    @endif
                                </td>
                                <td>


                                    <form method="POST" action="{{route('delete.testimonial', $testimonial->id)}}">
                                        @csrf
                                        <a href="{{route('edit.testimonial', $testimonial->id)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                        <input name="_method" type="hidden" value="POST">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
                                    </form>
                                </td>

                            </tbody>
                            @php $counter++; @endphp
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
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Testimonial?')) {
            e.preventDefault();
        }
    });
</script>
@endsection
