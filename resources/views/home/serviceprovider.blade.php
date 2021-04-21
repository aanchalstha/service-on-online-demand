
@include('include.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<br> <br>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Service Providers</h2>
<ol class="breadcrumb">
<li><a href="{{url('/')}}">Home /</a></li>
<li class="current">Service Providers</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section id="pricing-table" class="section-padding">
<div class="container">
<div class="row">
<div class="col-12">
<h2 class="section-title">Meet Our Extremely Qualified Service Providers</h2>
</div>
@foreach($providers as $provider)
<div class="col-lg-4 col-md-6 col-xs-12" >
    <div class="table" style="height:450px;">

        @if($provider->service_count == $max_service_count)
        <br>
        <span> <a href="{{ url('/service-providers/fav/'.$provider->id) }}" style="color:	#DAA520;"> <i class="fas fa-crown"></i> MOST LIKED PROVIDER </a></span>
        @endif
        <div class="icon">
           <img src="{{asset('uploads/serviceproviders/'.$provider->image )}}" style="width: 180px;height:180px;" alt="">
        </div>
    <div class="pricing-header">
        <p class="price-value">{{$provider->name}}</p>
    </div>
    <div class="title">
        <h3> <span class="badge badge-secondary"> {{$provider->category}} </span></h3>
    </div>
    @if($provider->available == 1)
    <span style="color:green;">  Available</span>
    @else
    <span style="color:red;"> In Service</span>
    @endif
    <br>
    <ul class="description">
        {{$provider->description}}
    </ul>

        {{-- <button class="btn btn-common">Purchase</button> --}}
    </div>
</div>
@endforeach

</div>
</div>
</section>



@include('include.footer')
