
@extends('customer.layouts.app')


@section('title')

Customer Services Section

@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 @section('content')

 <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Completed Services List</h5>
                </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead style="font-size:14px;">
                                <th>S.N.</th>
                                <th>Service Title</th>
                                <th>Service Provider </th>
                                <th>Service Category</th>
                                <th>Service Location</th>
                                <th>Service Date</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}

                            </thead>
                            @if(count($services) > 0)
                            @php $counter = 1; @endphp
                            @foreach($services as $data)

                            <tbody>

                                     <td> {{ $counter }}</td>
                                    <td> {{ $data->service_name}}</td>
                                    <td> {{ $data->service_provider}}</td>
                                    <td> {{ $data->category_name}}</td>
                                    <td> {{ $data->service_location}}</td>
                                    <td> {{ $data->service_date}}</td>
                                    <td>
                                        <span style="color:green;">Completed</span>
                                    </td>


                                    {{-- <td>
                                        <a href="{{ url('customer/view/service/requests/'.$data->id) }}" class="edit btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>&nbsp;
                                    </td> --}}
                            </tbody>
                            @php $counter++; @endphp
                            @endforeach
                            @else
                            <tbody>
                                <tr>
                                    <td colspan="7"> None of your services are in completed state. After one is completed, it is displayed here.</td>
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



