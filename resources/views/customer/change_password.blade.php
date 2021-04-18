

@extends('customer.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
       <h6> Change password</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('auth.change_password') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                <label for="current_password">Current password <span style="color:red">*</span></label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                @if($errors->has('current_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('current_password') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                <label for="new_password">New password <span style="color:red">*</span></label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
                @if($errors->has('new_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('new_password') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                <label for="new_password_confirmation">New password confirmation <span style="color:red">*</span> </label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                @if($errors->has('new_password_confirmation'))
                    <em class="invalid-feedback">
                        {{ $errors->first('new_password_confirmation') }}
                    </em>
                @endif
            </div>
            <div>
                   <a href="{{url('admin/settings')}}" class="btn btn-primary "> Go Back </button> </a>
                <input class="btn btn-primary" type="submit" value="Save">
            </div>
        </form>


    </div>
</div>
@endsection
