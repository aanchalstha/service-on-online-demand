@include('include.header')
<br><br><br>

<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Testimonial</h2>
<ol class="breadcrumb">
<li><a href="{{url('/')}}">Home /</a></li>
<li class="current">Testimonial</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section class="testimonial section-padding">
    <div class="container">
        @if (count($testimonials)>0)
        <center><h3>Hear What Clients Say about us!</h3></center>
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
        @else
        There are no testimonials available at the moment. Please check in later.
        @endif
    </div>
    </div>
    </section>
@include('include.footer')
