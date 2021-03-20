@extends('admin.layouts.app')

@section('title')

Roles Index

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
                    <h3>User Roles Listing</h3>
                    @if(session()->has('message'))
                    <div class="alert alert-custom">{{session()->get('message')}}</div>
                 @elseif(session()->has('error'))
                    <div class="alert alert-danger">{{session()->get('error')}} </div>
                @endif

                        <a href="{{ route('roles.create')}}" class="btn btn-primary ">Add Role</a>

                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="roles-table" class="table table-striped table-bordered">
                            <thead style="text-decoration: none;">
                                <tr style="font-size: 16px;font-weight:bold;">
                                    <td>
                                        ID
                                    </td>
                                    <td>
                                     Title
                                    </td>

                                    <td >
                                        Actions
                                    </td>

                                </tr>

                            </thead>
                            @foreach ($roles as $role)
                            <tbody>
                            <td>{{ $role->id}}</td>
                            <td>{{ $role->name}}</td>
                            <td>

                               <form method="POST" action="{{route('roles.delete', $role->id)}}">
                                @csrf
                                <a href="{{route('roles.permissions', $role->id)}}" class="edit btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;
                                <a href="{{route('roles.edit', $role->id)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                <input name="_method" type="hidden" value="POST">
                                <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
                            </form>
                            </td>
                            </tbody>
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
        if(!confirm('Are you sure you want to delete this Role?')) {
            e.preventDefault();
        }
    });
    $(function() {
        var self = this;
        $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('rolesData') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            @can('roles.edit')
            {data: 'action', name: 'action', orderable: false, searchable: false},
            @endcan
        ]
    });



    });
</script>
@endsection
