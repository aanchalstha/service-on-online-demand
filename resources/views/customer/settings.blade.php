@extends('customer.layouts.app')

@section('title')

Settings
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center">

                <div class="card-header">
                    <h6>Account Settings</h6>
                </div>

                <div class="card-body">


                <a href="{{ url('customer/')}}" class="btn btn-primary">Change Your Password</a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
