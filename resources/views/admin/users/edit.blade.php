@extends('admin.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        Edit User {{$user->fname}}  {{$user->fname}}
        @if($errors->count() > 0)
        <div class="alert alert-danger">
            Validation Error:
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ ucfirst($error) }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>

    <div class="card-body">
        <form action="{{ route("users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">First Name<span style="color:red;font-size:15px;" >&nbsp;*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" >
                @if($errors->has('fname'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif

            </div>

            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="password">Phone Number<span style="color:red;font-size:15px;" >&nbsp;*</span></label>
                <input type="number" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($user) ? $user->phone : '') }}">
                @if($errors->has('phone'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </em>
                @endif

            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">Email Address<span style="color:red;font-size:15px;" >&nbsp;*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" >
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif

            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Password<span style="color:red;font-size:15px;" >&nbsp;*</span></label>
                <input type="password" id="password" name="password" class="form-control" >
                @if($errors->has('password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em>
                @endif

            </div>
            <div>
                <a href="{{ route('users.index')}}"><button type="button" class="btn btn-danger float-left">Cancel</button></a>
                <input class="btn" type="submit" value="Update" style="background-color:#007481; color:snow;">
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')

@endsection
