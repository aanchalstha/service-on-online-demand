@extends('admin.layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
       Create User
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
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Full Name<span style="color:red;font-size:15px;" >&nbsp;*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" >
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif

            </div>



            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="password">Phone Number<span style="color:red;font-size:15px;" >&nbsp;*</span></label>
                <input type="number" id="phone" name="phone" class="form-control" >
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
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">Select Roles<span style="color:red;font-size:15px;" >&nbsp;*</span>
                    <span class="btn btn-info btn-xs select-all">select_all</span>
                    <span class="btn btn-info btn-xs deselect-all">deselect_all</span></label>
                <select name="roles[]" id="roles" class="form-control select2"  required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <em class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </em>
                @endif

            </div>
            <div>
                <a href="{{ route('users.index')}}"><button type="button" class="btn btn-danger float-left">Cancel</button></a>
                <input class="btn btn-success" type="submit" value="Save">

            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

    });
    $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', 'selected')
    $select2.trigger('change')
  })
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2')
    $select2.find('option').prop('selected', '')
    $select2.trigger('change')
  })

  $('.select2').select2()


</script>
@endsection
