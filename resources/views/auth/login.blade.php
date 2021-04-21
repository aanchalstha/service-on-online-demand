<!DOCTYPE html>
<html lang="en">


<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Login</title>
@include('include.css')
</head>
<body>
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
    <div class="container">
        <div style="float:right;">
            <a href="{{ url('/register')}}" class="btn btn-common">Register Instead</a>
        </div>
    <div class="row">
    <div class="col-md-12">
    <div class="breadcrumb-wrapper">
    <h2 class="product-title">Service On Online Demand <br> Login</h2>
    <ol class="breadcrumb">
    <li><a href="{{ url('/')}}">Home /</a></li>
    <li class="current">Login</li>

    </ol>

    </div>
    </div>
    </div>
    </div>
    </div>


    <section class="login section-padding">
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-5 col-md-12 col-xs-12">
    <div class="login-form login-area">
    <form method="POST" action="{{ route('login') }}" class="login-form">
    @csrf
        <div class="form-group">
        <div class="input-icon">
        <i class="lni-user"></i>
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>
        </div>
        <div class="form-group">
        <div class="input-icon">
        <i class="lni-lock"></i>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
        </div>
        <div class="form-group mb-3">
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="custom-control-label" for="checkedall">Remember Me </label>
        </div>
        <a class="forgetpassword" href="forgot-password.html">Forgot Password?</a>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-common log-btn">Login</button>

        </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </section>

