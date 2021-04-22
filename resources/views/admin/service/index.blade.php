@extends('admin.layouts.app')

@section('title')
Services Listing
@endsection

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Services Listing</h4>
              <a href="{{url('/admin/add/service')}}" class="btn btn-primary ">Add New Service</a>



              @if(session()->has('message'))
              <div class="alert alert-success">{{session()->get('message')}}</div>
           @elseif(session()->has('error'))
              <div class="alert alert-danger">{{session()->get('error')}} </div>
          @endif


            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <table id="blogs-table" class="table table-striped table-bordered">
                            <thead>
                                <tr style="font-size: 16px;font-weight:bold; ">
                                    <td >
                                       S.N.
                                    </td>
                                    <td>
                                       Service Name
                                    </td>
                                    <td >
                                        Featured Image
                                     </td>
                                    <td>
                                        Description
                                    </td>
                                    <td>
                                        Category
                                    </td>
                                    <td>
                                       Status
                                    </td>
                                    <td >
                                    Actions
                                    </td>
                                </tr>
                            </thead>
                            @php $counter=1; @endphp
                            @foreach ($services as $service)
                            <tbody>
                                <td >
                                   {{$counter }}
                                </td>
                                <td>
                                    {{$service->name}}
                                </td>
                                <td >
                                    <img src="{{asset('uploads/services/'.$service->service_image)}}" height="150">
                                 </td>
                                <td style="width:15rem;">
                                   {{ $service->description }}
                                </td>
                                <td>
                                    {{ $service->category_name }}
                                 </td>
                                <td>
                                    @if ($service->status == 1)
                                        <span style="color:green;">Active</span>

                                   @else
                                       <span style="color:red;">Not Active</span>

                                    @endif
                                </td>
                                <td >

                                 <form method="POST" action="{{route('delete.service', $service->id)}}">
                                    @csrf
                                    <a href="{{route('edit.service', $service->id)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
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
<script>
$('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this Service Data?')) {
            e.preventDefault();
        }
    });
</script>
@endsection
