@extends('admin.layouts.app')

@section('title')

Users Profile Section

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
              <h4 class="card-title">Users Listing</h4>


              @if(session()->has('message'))
              <div class="alert alert-custom">{{session()->get('message')}}</div>
           @elseif(session()->has('error'))
              <div class="alert alert-danger">{{session()->get('error')}} </div>
          @endif


          <a href="{{ route('users.create')}}" class="btn btn-primary ">Add User</a>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <table id="users-table" class="table table-striped table-bordered">
                            <thead>
                                <tr style="font-size: 16px;font-weight:bold; ">
                                    <td >
                                       User ID
                                    </td>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                        Email Address
                                    </td>
                                    <td >
                                        Role
                                     </td>

                                    <td >
                                    Actions
                                    </td>

                                </tr>
                            </thead>
                            @foreach($users as $user)
                            <tbody>
                                <td>
                                    {{$user->id }}
                                </td>
                                <td>
                                    {{$user->name }}
                                </td>
                                <td>
                                    {{$user->email }}
                                </td>
                                <td>
                                    @foreach($user->roles()->get() as $role)
                                    <span  style="font-weight:bold;">{{ $role->name }}</span> &nbsp; <br>
                                        @endforeach
                                </td>
                                <td>
                                   <a href="{{route('users.view', $user->id)}}" class="edit btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;
                                   <a href="{{route('users.edit', $user->id)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;

                                   <form method="POST" action="{{route('users.delete', $user->id)}}">
                                    @csrf
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
        if(!confirm('Are you sure you want to delete this User?')) {
            e.preventDefault();
        }
    });
</script>
@endsection

