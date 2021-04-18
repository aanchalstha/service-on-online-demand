@extends('admin.layouts.app')
@section('title')
Service on online demand

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
                        <h3>Service Requests Listing</h3>

                        @if(session()->has('message'))
                        <div class="alert alert-custom">{{session()->get('message')}}</div>
                     @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session()->get('error')}} </div>
                    @endif

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
                                       Member Name
                                    </td>
                                    <td>
                                        Service Name
                                    </td>

                                    <td>
                                        Service Location
                                    </td>
                                    <td>
                                        Service Date
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
                            @foreach($datas as $data)
                            <tbody>
                                <tr>
                                    <td>
                                        {{$counter}}
                                    </td>
                                    <td>
                                        {{$data->member_name}}
                                    </td>
                                    <td>
                                        {{$data->service_name}}

                                    </td>

                                    <td>
                                        {{$data->service_location}}

                                    </td>
                                    <td>
                                        {{$data->service_date}}

                                    </td>
                                    <td>
                                        @if($data->isCompleted == 1)
                                        <span style="color:green;">Completed</span>
                                        @elseif(($data->isCompleted !== 1) && (is_null($data->service_provider_id)))
                                        <span style="color:green;">In Queue</span>
                                        @elseif(($data->isCompleted !== 1) && (!is_null($data->service_provider_id)))
                                        <span style="color:green;">Assigned</span>
                                        @else
                                        <span style="color:red;">Cancelled</span>
                                        @endif

                                    </td>
                                    <td>

                                        <form method="POST" action="{{route('servicerequests.delete', $data->id)}}">
                                            @csrf
                                            <a href="{{ url('admin/edit/service/requests/'.$data->id) }}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
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


@endsection
@section('scripts')
<script>
 $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Service Request?')) {
            e.preventDefault();
        }
    });
</script>
@endsection
