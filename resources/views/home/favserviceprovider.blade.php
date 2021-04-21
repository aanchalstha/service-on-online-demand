@include('include.header')
<br><br>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

<div class="page-header" style="background: url({{asset('assets/')}}/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Most Liked Service Provider</h2>
<ol class="breadcrumb">
<li><a href="{{url('/')}}">Home /</a></li>
<li class="current">Service Provider</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<div class="section-padding">
<div class="container">
    <h4 class="widget-title">Services Offered by Service Provider</h4>
<div class="product-info row">
    @if(count($services)>0)
    @foreach($services as $service)
    <div class="col-lg-8 col-md-12 col-xs-12">

    <div class="details-box">
        <div class="product-img">
         <center>   <img class="img-fluid" src="{{ asset('uploads/services/'.$service->image)}}" alt="" style="height:200px;width:300px;"></center>
            </div>
    <div class="ads-details-info">
    <h2>{{ $service->name }}</h2>
    <p class="mb-4">Description: {{$service->description}} <br>
    Other Information: {!! $service->other_information !!}</p>
    </div>
    </div>
    @endforeach
    @else
    There has been some error. Please try again later.
    @endif
</div>
<div class="col-lg-4 col-md-6 col-xs-12">

<aside class="details-sidebar">
<div class="widget">
<h4 class="widget-title">Service Provider Details</h4>
<div class="agent-inner">
<div class="agent-title">
<div class="agent-photo">
<a href="#"><img src="{{asset('uploads/serviceproviders/'.$data->image )}}" alt="" style="height:70px;"></a>
</div>
<div class="agent-details">
<h3><a href="#">{{$data->name}}</a></h3>
</div>
</div>

<p>{{$data->description}}</p>
<p> <b> Services Count: </b>  {{$data->service_count}}</p>
<span style="color:	#DAA520;"> <i class="fas fa-crown"></i> MOST LIKED PROVIDER </span>

</div>
</div>

</aside>

</div>
</div>

</div>
</div>


<section class="subscribes section-padding">
<div class="container">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<div class="subscribes-inner">
<div class="icon">
<i class="lni-pointer"></i>
</div>
<div class="sub-text">
<h3>Subscribe to Newsletter</h3>
<p>and receive new ads in inbox</p>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
<form>
<div class="subscribe">
<input class="form-control" name="EMAIL" placeholder="Enter your Email" required="" type="email">
<button class="btn btn-common" type="submit">Subscribe</button>
</div>
</form>
</div>
</div>
</div>
</section>

@include('include.footer')
