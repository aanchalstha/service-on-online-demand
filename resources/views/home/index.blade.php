@include('include.header')

<div id="main-slide" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @if (count($banners)>0)
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('banner_uploads') }}/{{$banners[0]->image}}" alt="First slide">
            <div class="carousel-caption d-md-block">
                <h1 class="animated wow fadeInDown hero-heading" data-wow-delay=".4s">{{$banners[0]->banner_title}}</h1>
                <p class="animated fadeInUp wow hero-sub-heading" data-wow-delay=".6s">{{$banners[0]->banner_subtitle}}</p>
            </div>
        </div>
        @for($count = 1; $count <count($banners); $count++)
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('banner_uploads') }}/{{$banners[$count]->image}}" alt="{{$count}} slide">
            <div class="carousel-caption d-md-block">
                <h1 class="animated wow fadeInLeft hero-heading" data-wow-delay=".7s">{{$banners[0]->banner_title}}</h1>
                <p class="animated wow fadeInRight hero-sub-heading" data-wow-delay=".9s">{{$banners[0]->banner_subtitle}}</p>
            </div>
        </div>
        @endfor
        @endif
    </div>
    <a class="carousel-control-prev" href="#main-slide" role="button" data-slide="prev">
        <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left" data-ripple-color="#F0F0F0"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#main-slide" role="button" data-slide="next">
        <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right" data-ripple-color="#F0F0F0"></i></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="search-button">
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-12 col-xs-12">
<div class="search-bar">
<div class="search-inner">
<form class="search-form">
<div class="form-group inputwithicon">
<i class="lni-tag"></i>
<input type="text" name="customword" class="form-control" placeholder="What are you looking for?">
</div>
<div class="form-group inputwithicon">
<i class="lni-target"></i>
<div class="select">
<select>
<option value="none">Kathmandu</option>
<option value="none">Bhaktapur</option>
<option value="none">Lalitpur</option>
<option value="none">Outside Valley</option>

</select>
</div>
</div>
<div class="form-group inputwithicon">
<i class="lni-menu"></i>
 <div class="select">
<select>
<option value="none">Select Catagory</option>
@foreach($category as $data)
<option value="none">{{$data->name}}</option>
@endforeach
</select>
</div>
</div>
<button class="btn btn-common" type="button"><i class="lni-search"></i> Search Now</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<section class="categories-icon bg-light section-padding">
    <div class="container">
        <h1 class="section-title">Services By Category</h1>
        <div class="row">
            @foreach($category as $data)
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <a href="{{url('/category/services/'.$data->id)}}">
                    <div class="icon-box">
                        <div class="icon">
                           <img src="{{asset('uploads/'.$data->image)}}" alt="{{$data->image}}" style="height:80px; width:80px;">
                        </div>
                        <h4>{{$data->name}}</h4>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="featured section-padding">
<div class="container">
<h1 class="section-title">Featured Services</h1>
<div class="row">
    @foreach($services as $service)
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
            <div class="featured-box" style="width:500px;">
                <figure>
                    <div class="icon">
                        <span class="bg-green"><i class="lni-heart"></i></span>
                        <span><i class="lni-bookmark"></i></span>
                    </div>
                    <a href=""><img class="img-fluid" src="{{ asset('uploads') }}/services/{{$service->image}}" style="height: 300px;width:500px;" alt=""></a>
                </figure>
                <div class="feature-content" style="width:500px;">
                    {{-- <div class="product">
                        <a href="#">Electronic > </a>
                        <a href="#">Cameras</a>
                    </div> --}}
                    <h4><a href="">{{$service->name}}</a></h4>
                    <div class="meta-tag">
                        <span>
                            <a href="#"><i class="lni-star-filled"></i>Duration: {{$service->service_time}} Day(s)</a>
                        </span>

                    </div>
                    <p class="dsc">{{$service->description}}</p>
                    <div class="listing-bottom">
                        <h3 class="price float-left">Rs. {{$service->service_charge}}</h3>
                        <a href="ads-details.html" class="btn btn-common float-right">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


</div>
</div>
</section>



<section class="works section-padding">
<div class="container">
<div class="row">
<div class="col-12">
<h3 class="section-title">How Service on Online Demand Works?</h3>
</div>
<div class="col-lg-3 col-md-4 col-xs-10">
    <div class="works-item">
    <div class="icon-box">
    <i class="lni-search"></i>
    </div>
    <p>Browse the Service</p>
    </div>
    </div>
<div class="col-lg-3 col-md-4 col-xs-10">
<div class="works-item">
<div class="icon-box">
<i class="lni-users"></i>
</div>
<p>Create an Account</p>
</div>
</div>
<div class="col-lg-3 col-md-4 col-xs-10">
<div class="works-item">
<div class="icon-box">
<i class="lni-bookmark-alt"></i>
</div>
<p>Book the Service</p>
</div>
</div>
<div class="col-lg-3 col-md-4 col-xs-10">
<div class="works-item">
<div class="icon-box">
<i class="lni-thumbs-up"></i>
</div>
<p>Deal Done</p>
</div>
</div>
<hr class="works-line">
</div>
</div>
</section>




<section class="services section-padding">
<div class="container">
<div class="row">
<div class="col-12">
<h3 class="section-title">Why Choose Us? </h3>
</div>

<div class="col-md-6 col-lg-4 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="0.2s">
<div class="icon">
<i class="lni-leaf"></i>
</div>
<div class="services-content">
<h3><a href="#">Expert Service Providers</a></h3>
<p>Background checked and trained service providers.</p>
</div>
</div>
</div>

<div class="col-md-6 col-lg-4 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="1s">
<div class="icon">
<i class="lni-pencil-alt"></i>
</div>
<div class="services-content">
<h3><a href="#">Service Guarantee</a></h3>
<p>Guarantee of completion of service and review of service providers.</p>
</div>
</div>
</div>

<div class="col-md-6 col-lg-4 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="1.2s">
<div class="icon">
<i class="lni-headphone-alt"></i>
</div>
<div class="services-content">
<h3><a href="#">Hassle Free Service Delivery</a></h3>
<p>Convenient and easy access to hassle free services.</p>
</div>
</div>
</div>
</div>
</div>
</section>



<section class="testimonial section-padding">
<div class="container">
    <center><h3 class="section-title">Hear it from Our Clients</h3></center>
<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div id="testimonials" class="owl-carousel">
    @foreach($testimonials as $testimonial)
    <div class="item">
        <div class="img-thumb">
            <img src="{{ asset('uploads') }}/testimonials/{{$testimonial->image}}" alt="{{$testimonial->image}}" style="width:100px;height:100px;">
        </div>
        <div class="testimonial-item">
            <div class="content">
                <p class="description">{{$testimonial->text}}</p>
                <div class="info-text">
                    <h2><a href="#">{{$testimonial->name}}</a></h2>
                    <h4><a href="#">{{$testimonial->position}}</a></h4>
                </div>
            </div>
        </div>
    </div>
    @endforeach


</div>
</div>
</div>
</div>
</div>
</section>

{{--
<section id="blog" class="section-padding">

<div class="container">
<h2 class="section-title">
News and Events
</h2>
<div class="row">
<div class="col-lg-4 col-md-6 col-xs-12 blog-item">

<div class="blog-item-wrapper">
<div class="blog-item-img">
<a href="single-post.html">
<img src="{{ asset('assets') }}/img/blog/img-1.jpg" alt="">
</a>
</div>
<div class="blog-item-text">
<div class="meta-tags">
<span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By Admin</a></span>
<span class="date float-right"><i class="lni-calendar"></i> 24 May, 2018</span>
</div>
<h3>
<a href="single-post.html">Recently Launching Our Iphone X</a>
</h3>
<p>
Reprehenderit nemo quod tempore doloribus ratione distinctio quis quidem vitae sunt reiciendis, molestias omnis soluta.
</p>
<a href="single-post.html" class="btn btn-common">Read More</a>
</div>
</div>

</div>
<div class="col-lg-4 col-md-6 col-xs-12 blog-item">

<div class="blog-item-wrapper">
<div class="blog-item-img">
<a href="single-post.html">
<img src="{{ asset('assets') }}/img/blog/img-2.jpg" alt="">
</a>
</div>
<div class="blog-item-text">
<div class="meta-tags">
<span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By Admin</a></span>
<span class="date float-right"><i class="lni-calendar"></i> 24 May, 2018</span>
</div>
<h3>
<a href="single-post.html">How to get more ad views</a>
</h3>
<p>
Reprehenderit nemo quod tempore doloribus ratione distinctio quis quidem vitae sunt reiciendis, molestias omnis soluta.
</p>
<a href="single-post.html" class="btn btn-common">Read More</a>
</div>
</div>

</div>
<div class="col-lg-4 col-md-6 col-xs-12 blog-item">

<div class="blog-item-wrapper">
<div class="blog-item-img">
<a href="single-post.html">
<img src="{{ asset('assets') }}/img/blog/img-3.jpg" alt="">
</a>
</div>
<div class="blog-item-text">
<div class="meta-tags">
<span class="user float-left"><a href="#"><i class="lni-user"></i> Posted By Admin</a></span>
<span class="date float-right"><i class="lni-calendar"></i> 24 May, 2018</span>
</div>
<h3>
<a href="single-post.html">Writing a better product description</a>
</h3>
<p>
Reprehenderit nemo quod tempore doloribus ratione distinctio quis quidem vitae sunt reiciendis, molestias omnis soluta.
</p>
<a href="single-post.html" class="btn btn-common">Read More</a>
</div>
</div>

</div>
</div>
</div>
</section> --}}


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
