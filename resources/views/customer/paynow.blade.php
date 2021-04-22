
@extends('customer.layouts.app')


@section('title')

Payment Details Section

@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 @section('content')

 <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Payment Details for {{$data->service_name}} </h4>
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
                                        Service Date and Duration
                                    </td>
                                    <td>
                                        {{$data->service_date}},
                                        {{$data->duration}} Day(s)

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
                                        Service Location
                                    </td>
                                    <td>
                                        {{$data->service_location}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Service Cost
                                    </td>
                                    <td>
                                      {{$data->price}}

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        QR Code (Cash On Delivery)
                                    </td>
                                    <td>
                                        <img src="{{ asset('assets/img/qrcode.png')}}" alt="" style="height:150px;width:150px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Instructions
                                    </td>
                                    <td style="width:45rem;">
                                        Please complete the payment and wait for the confirmation by Service Provider or Site Administrator. After the confirmation is done, your service will be set on Completed state.
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
