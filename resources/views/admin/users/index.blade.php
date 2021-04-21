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
              <h2 class="card-title">Administrator Users Listing</h2>


              @if(session()->has('message'))
              <div class="alert alert-custom alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" style="float:right;">&times;</a>
                  {{session()->get('message')}}</div>

           @elseif(session()->has('error'))
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" style="float:right;">&times;</a>
                {{session()->get('error')}} </div>

          @endif


          <a href="{{ route('users.create')}}" class="btn btn-primary " >Add Admin User</a>

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
                                        Usertype
                                    </td>
                                    <td>
                                        Email Address
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
                                    @if(Auth::user()->id == $user->id)
                                    {{$user->name }} <span class="badge badge-primary" >Logged In</span>
                                    @else
                                    {{$user->name }}
                                    @endif
                                </td>
                                <td>

                                    {{ucfirst($user->usertype) }}

                                </td>
                                <td>
                                    {{$user->email }}
                                </td>
                                <td>


                                   <form method="POST" action="{{route('users.delete', $user->id)}}">
                                    @csrf
                                    <a href="{{route('users.view', $user->id)}}" class="edit btn btn-info btn-md"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;
                                    <a href="{{route('users.edit', $user->id)}}" class="edit btn btn-primary btn-md"><i class="fas fa-edit"></i></a>&nbsp;
                                    <input name="_method" type="hidden" value="POST">
                                    <button type="submit" class="btn btn-md btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
 $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this User?')) {
            e.preventDefault();
        }
    });
</script>
@endsection

