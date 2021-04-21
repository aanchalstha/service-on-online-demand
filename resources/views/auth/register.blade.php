<!DOCTYPE html>
<html lang="en">


<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Register</title>
@include('include.css')
</head>
<body>


<div class="page-header" style="background: url(assets/img/banner1.jpg);">
<div class="container">
<div class="row">

<div class="col-md-12">
<div class="breadcrumb-wrapper">
    <div style="float:right;">
        <a href="{{ url('/login')}}" class="btn btn-common">Back to login</a>
    </div>
<h2 class="product-title">Register to Service On Online Demand</h2>
<ol class="breadcrumb">
<li><a href="{{url('/')}}">Home /</a></li>
<li class="current">Register</li>
</ol>
</div>
</div>
</div>
</div>
</div>


<section class="register section-padding">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5 col-md-12 col-xs-12">
<div class="register-form login-area">
<h3>
Register
</h3>
<form method="POST" action="{{ route('register') }}" class="login-form">
    @csrf

<div class="form-group">
<div class="input-icon">
<i class="lni-user"></i>
<input type="text" placeholder="Full Name" id="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
</div>
</div>
<div class="form-group">
<div class="input-icon">
<i class="lni-envelope"></i>
<input type="text" id="sender-email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
</div>
</div>
<div class="form-group">
    <div class="input-icon">
    <i class="lni-lock"></i>
    <input id="phone" placeholder="Phone Number" type="text" pattern="([9][8|7][0-9]{8})" maxlength="10"
    minlength="10" required class="form-control @error('phone') is-invalid @enderror" name="phone"
    value="{{ old('phone') }}">

    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
</div>

<div class="form-group">
<div class="input-icon">
<i class="lni-lock"></i>
<input id="password" type="password"  placeholder="Enter your Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
</div>
<div class="form-group">
<div class="input-icon">
<i class="lni-lock"></i>
<input id="password-confirm" type="password" class="form-control" placeholder="Re-enter your Password" name="password_confirmation" required autocomplete="new-password">
</div>
</div>
<div class="form-group mb-3">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="checkedall" required>
<label class="custom-control-label" for="checkedall">By registering, you accept our Terms & Conditions</label>
</div>
</div>
<div class="text-center">
<button class="btn btn-common log-btn">Register</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
