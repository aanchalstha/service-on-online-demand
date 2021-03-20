@extends('admin.layouts.app')

@section('title')
Blog
@endsection

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">News and Events Listing</h4>
              <a href="{{url('/admin/blog/new-post')}}" class="btn btn-primary ">Add New +</a>



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
                                       Title
                                    </td>
                                    <td >
                                        Featured Image
                                     </td>
                                    <td>
                                        Slug
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
                            @foreach ($posts as $post)
                            <tbody>
                                <td >
                                   {{$counter }}
                                </td>
                                <td>
                                    {{$post->title}}
                                </td>
                                <td >
                                    <img src="{{asset('uploads/blogs/'.$post->image)}}" height="150">
                                 </td>
                                <td>
                                   {{ $post->slug }}
                                </td>
                                <td>
                                    @if ($post->active == 1)
                                        <span style="color:green;">Active</span>

                                   @else
                                       <span style="color:red;">Not Active</span>

                                    @endif
                                </td>
                                <td >
                                    <a href="{{route('blog.edit', $post->slug)}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                                 <form method="POST" action="{{route('blog.delete', $post->id)}}">
                                    @csrf
                                    <input name="_method" type="hidden" value="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash"> </i></button>
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
        if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    });
</script>
@endsection
