@extends('admin.layouts.app')
@section('title')

Service Provider Index

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
                        <h3>Service Providers Listing</h3>

                        @if(session()->has('message'))
                        <div class="alert alert-custom">{{session()->get('message')}}</div>
                     @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}} </div>
                    @endif

                    <a href="{{url('admin/add/service-provider')}}" class="btn btn-primary ">Add New Service Provider</a>&nbsp;&nbsp;&nbsp;


                    </div>

                    <div class="card-body">
                        <span style="color:grey;font-weight:bold;"> Sort by Joined Date:
                            <a href="{{ url('admin/service-provider/sort/ascending') }}" style="color:grey;font-weight:bold;text-decoration: none;"> <i class="fa fa-arrow-up" aria-hidden="true"></i>  Ascending</a>&nbsp;
                            <a href="{{ url('admin/service-provider/sort/descending') }}" style="color:grey;font-weight:bold;text-decoration; text-decoration: none;"><i class="fa fa-arrow-down" aria-hidden="true"></i> Descending</a></span>

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
                                       Category
                                    </td>
                                    <td>
                                        Image
                                    </td>
                                    <td>
                                        Description
                                    </td>
                                    <td>
                                       Created at
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
                            @foreach($serviceproviders as $data)
                            <tbody>
                                <td>
                                    {{$counter }}
                                </td>
                                <td>
                                    {{$data->name }}
                                </td>
                                <td>
                                    {{$data->category_name }}
                                </td>
                                <td>
                                    <img src="{{asset('uploads/serviceproviders/'.$data->image )}}" style="width: 100px;height:100px;" />
                                </td>
                                <td style="width:15rem;">
                                    {{$data->description }}
                                </td>
                                <td>
                                   <span class="badge badge-primary"> {{$data->created_at }}</span>
                                </td>
                                <td>
                                    @if ($data->status==1)
                                        <span style="color:green;">Active</span>

                                   @else
                                       <span style="color:red;">Not Active</span>

                                    @endif
                                </td>
                                <td>


                                    <form method="POST" action="{{route('delete.service-provider', $data->id)}}">
                                        @csrf
                                        <a href="{{route('edit.service-provider', $data->id)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
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


@endsection
@section('scripts')
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Service Provider?')) {
            e.preventDefault();
        }
    });
</script>
@endsection
