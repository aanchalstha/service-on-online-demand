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

            <div class="card" >


                <div class="card-header">
                    <h3>Create Role</h3>

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

                    <a href="{{ route('roles.view')}}"> <i class="fas fa-backward"></i>  Go Back</a>
                </div>
            <form action="{{ route('roles.store')}}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="title">Title<span style="color:red;font-size:15px;">&nbsp;*</span></label><br>

                        <input type="text" name="name" class="form-control" placeholder="" ><br>
                    </div>
                    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                        <label for="permission">Permissions<span style="color:red;font-size:15px;">&nbsp;*</span>
                            <span class="btn btn-info btn-xs select-all">select_all</span>
                            <span class="btn btn-info btn-xs deselect-all">deselect_all</span></label>
                        <select name="permission[]" id="permission" class="form-control select2" multiple="multiple" required>
                            @foreach($permissions as $id => $permissions)
                                <option value="{{ $id }}" {{ (in_array($id, old('permission', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('permission'))
                            <em class="invalid-feedback">
                                {{ $errors->first('permission') }}
                            </em>
                        @endif

                    </div>

                            <button type="submit" class="btn btn-primary float-left">Add Permission</button>
                            <a href="{{ route('roles.view')}}"><button type="button" class="btn btn-danger float-left">Cancel</button></a>

                </div>
            </div>
        </form>
        </div>
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
