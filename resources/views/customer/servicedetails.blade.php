
@extends('customer.layouts.app')


@section('title')

SR Details Section

@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 @section('content')

 <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Service Request Details for {{$data->service_name}} </h4>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td>
                                       Service Title
                                    </td>
                                    <td>
                                        {{$data->service_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Service Category
                                    </td>
                                    <td>
                                        {{$data->category_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Service Charge
                                    </td>
                                    <td>
                                       Rs. {{$data->price}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Service Duration
                                    </td>
                                    <td>
                                      {{$data->duration}} Day(s)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Service Date
                                    </td>
                                    <td>
                                        {{$data->service_date}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Service Location
                                    </td>
                                    <td>
                                        {{$data->service_location}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Service Provider
                                    </td>
                                    <td>
                                        @if ($data->service_provider_id)
                                        {{$data->service_provider}}
                                        @else
                                        <span style="color:red"> Not Assigned Yet</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Description
                                    </td>
                                    <td>
                                        {{$data->description}}
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                       Status
                                    </td>
                                    <td>
                                        @if($data->is_completed == 1)
                                        <span style="color:green;">Completed</span>
                                        @elseif(($data->is_completed !== 1) && (is_null($data->service_provider_id)))
                                        <span style="color:green;">In Queue</span>
                                        @else
                                        <span style="color:red;">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        Service Request Date/Time
                                    </td>
                                    <td>
                                        {{$data->created_at}}

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-danger" href="{{ url()->previous() }}">
                            GO BACK
                        </a>
                    </div>


                </div>
</div>
@endsection
