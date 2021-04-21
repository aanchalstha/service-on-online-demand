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
              <h4 class="card-title"> Viewing the details of User: {{ $user->name }}</h4>

              @if(session()->has('message'))
              <div class="alert alert-custom">{{session()->get('message')}}</div>
           @elseif(session()->has('error'))
              <div class="alert alert-danger">{{session()->get('error')}} </div>
          @endif

            </div>
            <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                           User Id
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           User's Name
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            User's Email
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone Number
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created At
                        </th>
                        <td>
                            {{ $user->created_at }}
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
