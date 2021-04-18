<!DOCTYPE html>
<html lang="en">


<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Service On Online Demand</title>
@include('include.css')
</head>
<body>

<header id="header-wrap">

<div class="top-bar">
<div class="container">
<div class="row">
<div class="col-lg-7 col-md-5 col-xs-12">

<ul class="list-inline">
  <p style="margin-top:5px; font-weight:bold;">
    @auth
     Hello! {{Auth::user()->name }}
    @endauth
</p>
</ul>

</div>
<div class="col-lg-5 col-md-7 col-xs-12">
<div class="header-top-right float-right">
    @guest
    <a href="{{ url('login')}}" class="header-top-button"><i class="lni-lock"></i> Log In</a>
    <a href="{{ url('register')}}" class="header-top-button"><i class="lni-pencil"></i> Register</a>
    @else
    <a href="{{ route('home')}}" class="header-top-button"><i class="lni-dashboard"></i> Dashboard</a>
    <a class="header-top-button" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
    <i class="lni lni-share-alt"></i> {{ __('Logout') }}
 </a>

 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
     @csrf
 </form>
    @endguest
</div>
</div>
</div>
</div>
</div>


<nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar">
<div class="container">

<div class="navbar-header">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
</button>
<a href="{{ url('/')}}" class="navbar-brand"><img src="assets/img/logo.png" alt=""></a>
</div>
<div class="collapse navbar-collapse" id="main-navbar">
<ul class="navbar-nav mr-auto w-100 justify-content-center">
<li class="nav-item  {{ '/' == request()->path() ? 'active' :'' }}">
<a class="nav-link" href="{{ url('/') }}" >
Home
</a>

</li>

<li class="nav-item {{ 'services' == request()->path() ? 'active' :'' }}">
    <a class="nav-link" href="{{ url('/services')}}">
    Services
    </a>
    </li>
</li>
{{-- <li class="nav-item {{ 'services' == request()->path() ? 'active' :'' }}">
    <a class="nav-link" href="{{ url('/services')}}">
    Service Providers
    </a>
    </li>
</li> --}}

<li class="nav-item {{ 'about' == request()->path() ? 'active' :'' }}">
    <a class="nav-link" href="{{ url('/about')}}">
    About
    </a>
    </li>
</li>

<li class="nav-item {{ 'testimonial' == request()->path() ? 'active' :'' }}">
    <a class="nav-link" href="{{ url('/testimonial')}}">
    Testimonials
    </a>
    </li>
</li>

<li class="nav-item {{ 'contact' == request()->path() ? 'active' :'' }}">
<a class="nav-link" href="{{ url('/contact')}}">
Contact
</a>
</li>
</ul>

</div>

<ul class="mobile-menu">
<li>
<a class="active" href="#">
Home
</a>

</li>
<li>
<a href="category.html">Categories</a>
</li>
<li>
<a href="#">
Services
</a>

</li>

{{-- <li>
    <a href="#">
    Service Providers
    </a>

    </li> --}}

<li>
<a href="#">About Us</a>

</li>
<li>
    <a href="#">Testimonials</a>

    </li>

<li>
<a href="contact.html">Contact </a>
</li>
</ul>

</nav>

</header>
