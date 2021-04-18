
@extends('customer.layouts.app')


@section('title')

Customer SR Section

@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 @section('content')

 <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>My Service Requests Status</h5>
                </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead style="font-size:14px;">
                                <th>S.N.</th>
                                <th>Service Title</th>
                                <th>Service Category</th>
                                <th>Service Location</th>
                                <th>Service Date</th>
                                <th>Status</th>
                                <th>Action</th>

                            </thead>
                            @if(count($services) > 0)
                            @php $counter = 1; @endphp
                            @foreach($services as $data)

                            <tbody>

                                     <td> {{ $counter }}</td>
                                    <td> {{ $data->service_name}}</td>
                                    <td> {{ $data->category_name}}</td>
                                    <td> {{ $data->service_location}}</td>
                                    <td> {{ $data->service_date}}</td>
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
                                        <a href="{{ url('customer/view/service/requests/'.$data->id) }}" class="edit btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>&nbsp;
                                    </td>
                            </tbody>
                            @php $counter++; @endphp
                            @endforeach
                            @else
                            <tbody>
                                <tr>
                                    <td colspan="7"> There are No Service Requests Currently. Please Request a Service To see its status here.</td>
                                </tr>
                            </tbody>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection



