@include('include.css')


<div class="page-header" style="background: url({{asset('assets')}}/img/banner1.jpg);">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<h2 class="product-title">Request Service - {{$service->service_name}}</h2>
<ol class="breadcrumb">
<li><a href="{{url('/')}}">Home /</a></li>
<li class="current">Request Service</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<div id="content" class="section-padding">
<div class="container">
<div class="row">

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
<div class="inner-box">
<div class="dashboard-box">
<h2 class="dashbord-title">Selected Service Details</h2>
</div>
<div class="dashboard-wrapper">
<div class="form-group mb-3">
<label class="control-label">Service Title</label>
<input class="form-control input-md" readonly value="{{$service->service_name}}" placeholder="Title" type="text">
</div>
<div class="form-group mb-3">
    <label class="control-label">Service Category</label>
    <input class="form-control input-md" readonly value="{{$service->category_name}}" placeholder="Title" type="text">
    </div>
<div class="form-group mb-3">
<label class="control-label">Service Cost</label>
<input class="form-control input-md" readonly value="Rs. {{$service->service_charge}}" type="text">

</div>
<div class="form-group mb-3">
    <label class="control-label">Service Duration</label>
    <input class="form-control input-md" readonly value="{{$service->service_time}} Day(s)" type="text">

    </div>
<div class="form-group md-3">
<section id="editor">
<small> Note: After you confirm the service details, you will be contacted by the service provider.</small>
</section>
</div>
</div>
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="inner-box">
        <div class="tg-contactdetail">
            <div class="dashboard-box">
                <h2 class="dashbord-title">Other Details to be Specified</h2>
            </div>
            <form action="{{url('customer/register/service')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="dashboard-wrapper">
                <input type="hidden" value="{{$service->id}}" name="service_id">
                <div class="form-group mb-3">
                    <label class="control-label">Enter Service Location <span style="color:red">*</span></label>
                    <input class="form-control input-md" name="service_location" type="text" required>
                </div>
                <div class="form-group mb-3">
                    <label class="control-label">Enter Service Date <span style="color:red">*</span></label>
                    <input class="form-control input-md" name="service_date" type="date" required>
                </div>
                <div class="form-group mb-3">
                    <label class="control-label">Specify Details of the Service  <span style="color:red">*</span></label>
                    <textarea class="form-control input-md" rows="6" name="service_description" type="text" required> </textarea>
                </div>

                <button class="btn btn-common" type="submit">Book Service</button>
                <button class="btn btn-common" href="{{ url('/')}}" type="button">Cancel</button>
            </div>
        </form>
        </div>
    </div>
</div>


</div>
</div>
</div>
</div>
</div>
@include('include.footer')
