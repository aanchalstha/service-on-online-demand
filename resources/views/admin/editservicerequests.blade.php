
@extends('admin.layouts.app')


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
                        <form action="{{ action('HomeController@updateServiceRequest', $data->id) }}" method="post" >
                            @csrf

                        <input type="hidden" value="{{$data->id}}" name="service_id">
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
                                      {{$data->duration}} Hour(s)
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
                                        <select class="form-control" name="provider_id" id="exampleFormControlSelect1"  autocomplete="off">
                                            @foreach($serviceproviders as $provider)
                                                @if($data->service_provider_id == $provider->id)
                                                <option value="{{$provider->id}}" selected>{{$provider->name}}</option>
                                                @else
                                                    @if($provider->available == 1)
                                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        @else
                                        <select class="form-control" name="service_provider_id" id="exampleFormControlSelect1"  autocomplete="off">
                                            <option  disabled selected> Select Service Provider</option>
                                            @foreach($serviceproviders as $provider)
                                            @if($provider->available == 1)
                                            <option value="{{$provider->id}}">{{$provider->name}}</option>
                                            @endif
                                             @endforeach
                                        </select>
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
                                        Service Request Date/Time
                                    </td>
                                    <td>
                                        {{$data->created_at}}

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Payment Status
                                    </td>
                                    <td>
                                        <select class="form-control" name="has_paid" id="exampleFormControlSelect1"  autocomplete="off">
                                            <option  disabled selected> Select Service Payment Status</option>
                                           @if(($data->has_paid) == TRUE){
                                            <option value="0">Not Paid</option>
                                            <option value="1" selected>Paid</option>
                                           }
                                           @else
                                            <option value="0" selected>Not Paid</option>
                                            <option value="1">Paid</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Is Service Completed?
                                    </td>
                                    <td>
                                        <select class="form-control" name="is_completed" id="exampleFormControlSelect1"  autocomplete="off">
                                            <option  disabled selected> Select Service Completion Status</option>
                                           @if(($data->isCompleted) == TRUE){
                                            <option value="0">Not Completed</option>
                                            <option value="1" selected>Completed</option>
                                           }
                                           @else
                                            <option value="0" selected>Not Completed</option>
                                            <option value="1">Completed</option>
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a class="btn btn-danger" href="{{ url()->previous() }}">
                            GO BACK
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
